<style>
  .on {
    border-bottom: 2px solid red;
  }
</style>
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">统计</h3>
    <div class="box-tools">
      <div class="btn-group float-right" style="margin-right: 10px">
        <a href="/admin/orders" class="btn btn-sm btn-default"><i class="fa fa-list"></i> 列表</a>
      </div>
    </div>
  </div>
  <div class="box-body">
    <ul class="nav nav-pills">
      <li class="nav-item">
        @if(request()->date)
          <a class="nav-link {{ system_nav_active('cid','today') }}"
             href="{{ route('admin.home.index',['type'=>'cid','date'=>'today']) }}">今天</a>
        @else
          <a class="nav-link {{ active_class(if_route('admin.home.index')) }}"
             href="{{ route('admin.home.index') }}">今天</a>
        @endif
      </li>
      <li class="nav-item">
        <a class="nav-link {{ system_nav_active('cid','yesterday') }}"
           href="{{ route('admin.home.index',['type'=>'cid','date'=>'yesterday']) }}">昨天</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ system_nav_active('cid','month') }}"
           href="{{ route('admin.home.index', ['type'=>'cid','date'=>'month']) }}">本月</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ system_nav_active('cid','pre_month') }}"
           href="{{ route('admin.home.index', ['type'=>'cid','date'=>'pre_month']) }}">上月</a>
      </li>
    </ul>
    <div class="row">
      <div class="col-md-6">
        <h3 class="">按系统统计</h3>
        <table class="table custom-data-table dataTable category">
          <thead>
          <tr>
            <th>系统名称</th>
            <th>付款订单数/总订单数</th>
            <th>付款率</th>
            <th>付款金额</th>
          </tr>
          </thead>
          <tbody>
          @foreach($class_orders as $order)
            <tr>
              <td>{{ $order->name }}</td>
              @switch(request()->date)
                @case('yesterday')
                @php
                  $pay_orders = $order->orders->count();
                    $today_orders = \App\Models\Order::whereBetween('created_at',[\Carbon\Carbon::now()->subDay()->startOfDay(), \Carbon\Carbon::now()->subDay()->endOfDay()])->where('cid',$order->id)->count();
                    try {
                    $today_data = $pay_orders/$today_data;
                }catch (\Exception $e){
                    $today_data=0;
                }
                @endphp
                <td>
                  {{$pay_orders .'/'.$today_orders}}
                </td>
                <td>{{@number_format( $today_data*100,2)}}
                  %
                </td>
                @break
                @case('month')
                <td>{{$order->orders->count().'/'.\App\Models\Order::whereBetween('created_at',[\Carbon\Carbon::now()->startOfMonth(), \Carbon\Carbon::now()->endOfMonth()])->where('cid',$order->id)->count()}}</td>
                @break
                @case('pre_month')
                <td>{{$order->orders->count().'/'.\App\Models\Order::whereBetween('created_at',[\Carbon\Carbon::now()->subMonth()->startOfMonth(), \Carbon\Carbon::now()->subMonth()->endOfMonth()])->where('cid',$order->id)->count()}}</td>
                @break
                @default
                <td>{{$order->orders->count().'/'.\App\Models\Order::whereBetween('created_at',[\Carbon\Carbon::now()->startOfDay(), \Carbon\Carbon::now()->endOfDay()])->where('cid',$order->id)->count()}}</td>
              @endswitch

              <td>{{ $order->orders->sum('pay_price') }}元</td>
            </tr>

          @endforeach
          <tr>
            <td>总计</td>
            <td></td>
            <td></td>
            <td id="total_price" class="text-danger fontsize-ensurer">0</td>
          </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-6">
        <h3>按来源统计</h3>
        <table class="table custom-data-table dataTable source">
          <thead>
          <tr>
            <th>来源</th>
            <th>付款订单数/总订单数</th>
            <th>付款率</th>
            <th>付款金额</th>
          </tr>
          </thead>
          <tbody>
          @foreach($source_orders as $source=> $order)
            <tr>
              <td>{{ $source }}</td>
              @switch(request()->date)
                @case('yesterday')
                <td>{{$order->count().'/'.\App\Models\Order::whereBetween('created_at',[\Carbon\Carbon::now()->subDay()->startOfDay(), \Carbon\Carbon::now()->subDay()->endOfDay()])->where('from',$source)->count()}}</td>
                @break
                @case('month')
                <td>{{$order->count().'/'.\App\Models\Order::whereBetween('created_at',[\Carbon\Carbon::now()->startOfMonth(), \Carbon\Carbon::now()->endOfMonth()])->where('from',$source)->count()}}</td>
                @break
                @case('pre_month')
                <td>{{$order->count().'/'.\App\Models\Order::whereBetween('created_at',[\Carbon\Carbon::now()->subMonth()->startOfMonth(), \Carbon\Carbon::now()->subMonth()->endOfMonth()])->where('from',$source)->count()}}</td>
                @break
                @default
                <td>{{$order->count().'/'.\App\Models\Order::whereBetween('created_at',[\Carbon\Carbon::now()->startOfDay(), \Carbon\Carbon::now()->endOfDay()])->where('from',$source)->count()}}</td>
              @endswitch
              <td>{{@number_format($order->count()/(\App\Models\Order::query()->whereNotNull('date_pay')->count()) *100,2)}}
                %
              </td>
              <td>{{ $order->sum('pay_price') }}元</td>
            </tr>

          @endforeach
          <tr>
            <td>总计</td>
            <td></td>
            <td></td>
            <td id="source_total_price" class="text-danger fontsize-ensurer">0</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script !src="">
  $(() => {
    var category_total = 0;
    $(".category tr").each(function () {
      //td:eq(3)从0开始计数
      $(this).find("td:eq(3)").each(function () {
        category_total += parseFloat($(this).text());
      });
    });
    $('#total_price').text(category_total.toFixed(2))
    var source_total = 0;
    $(".source tr").each(function () {
      //td:eq(3)从0开始计数
      $(this).find("td:eq(3)").each(function () {
        source_total += parseFloat($(this).text());
      });
    });
    $('#source_total_price').text(source_total.toFixed(2))
  })

  {{--$(() => {--}}
  {{--  $.ajax({--}}
  {{--    url: "{{ route('admin.home.statis',['type'=>'cid','date'=> '']) }}",--}}
  {{--    type: 'GET',--}}
  {{--  }).then(res => {--}}
  {{--    console.log(res.data)--}}
  {{--  });--}}
  {{--  // $('.system a').click(() => {--}}
  {{--  //--}}
  {{--  // })--}}
  {{--})--}}
</script>

{{--<script !src="">--}}
{{--  $(() => {--}}
{{--    $('#upload-btn').click(() => {--}}
{{--      swal({--}}
{{--        title: '确认要重新上传该订单的文件？',--}}
{{--        type: 'warning',--}}
{{--        showCancelButton: true,--}}
{{--        confirmButtonText: "确认",--}}
{{--        cancelButtonText: "取消",--}}
{{--        showLoaderOnConfirm: true,--}}
{{--        preConfirm: function () {--}}
{{--          // Laravel-Admin 没有 axios，使用 jQuery 的 ajax 方法来请求--}}
{{--          return $.ajax({--}}
{{--            url: '',--}}
{{--            type: 'POST',--}}
{{--            data: JSON.stringify({   // 将请求变成 JSON 字符串--}}
{{--              agree: false,  // 拒绝申请--}}
{{--              reason: inputValue,--}}
{{--              // 带上 CSRF Token--}}
{{--              // Laravel-Admin 页面里可以通过 LA.token 获得 CSRF Token--}}
{{--              _token: LA.token,--}}
{{--            }),--}}
{{--            contentType: 'application/json',  // 请求的数据格式为 JSON--}}
{{--          });--}}
{{--        },--}}
{{--        allowOutsideClick: false--}}
{{--      }).then(function (ret) {--}}
{{--        // 如果用户点击了『取消』按钮，则不做任何操作--}}
{{--        if (ret.dismiss === 'cancel') {--}}
{{--          return;--}}
{{--        }--}}
{{--        swal({--}}
{{--          title: '操作成功',--}}
{{--          type: 'success'--}}
{{--        }).then(function () {--}}
{{--          // 用户点击 swal 上的按钮时刷新页面--}}
{{--          location.reload();--}}
{{--        });--}}
{{--      });--}}
{{--    })--}}
{{--  })--}}
{{--</script>--}}
