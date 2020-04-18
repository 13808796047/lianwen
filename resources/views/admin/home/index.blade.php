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
      <li role="presentation" class="{{ system_nav_active('cid','today') }}"><a
          href="{{ route('admin.home.index',['type'=>'cid','date'=>'today']) }}">今天</a></li>
      <li role="presentation" class="{{ system_nav_active('cid','yesterday') }}"><a
          href="{{ route('admin.home.index',['type'=>'cid','date'=>'yesterday']) }}">昨天</a></li>
      <li role="presentation" class="{{ system_nav_active('cid','month') }}"><a
          href="{{ route('admin.home.index', ['type'=>'cid','date'=>'month']) }}">本月</a></li>
      <li role="presentation" class="{{ system_nav_active('cid','pre_month') }}"><a
          href="{{ route('admin.home.index', ['type'=>'cid','date'=>'pre_month']) }}">上月</a></li>
    </ul>
    <div class="row">
      <div class="col-md-6">
        <h3>按系统统计</h3>

        <table class="table-bordered table text-center category">
          <tr>
            <th>系统名称</th>
            <th>付款订单数/总订单数</th>
            <th>付款率</th>
            <th>付款金额</th>
          </tr>
          @foreach($class_orders as $order)
            <tr>
              <td>{{ $order->name }}</td>
              <td>{{$order->orders->count().'/'.$total_orders->count()}}</td>
              <td>{{@number_format(($order->orders->count()/(\App\Models\Order::query()->whereNotNull('date_pay')->count()) *100),2)}}
                %
              </td>
              <td>{{ $order->orders->sum('pay_price')}}元</td>
            </tr>

          @endforeach
          <tr>
            <td>总计</td>
            <td></td>
            <td></td>
            <td id="total_price" class="text-danger fontsize-ensurer">0</td>
          </tr>
        </table>
      </div>
      <div class="col-md-6">
        <h3>按来源统计</h3>
        <table class="table table-bordered source">
          <tr>
            <th>来源</th>
            <th>付款订单数/总订单数</th>
            <th>付款率</th>
            <th>付款金额</th>
          </tr>
          @foreach($source_orders as $source=> $order)
            <tr>
              <td>{{ $source }}</td>
              <td>{{$order->count().'/'.\App\Models\Order::query()->whereNotNull('date_pay')->count()}}</td>
              <td>{{@number_format($order->count()/(\App\Models\Order::query()->whereNotNull('date_pay')->count()) *100,2)}}
                %
              </td>
              <td>{{ $order->sum('pay_price')}}元</td>
            </tr>

          @endforeach
          <tr>
            <td>总计</td>
            <td></td>
            <td></td>
            <td id="source_total_price" class="text-danger fontsize-ensurer">0</td>
          </tr>
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
    $('#total_price').text(category_total)
    var source_total = 0;
    $(".source tr").each(function () {
      //td:eq(3)从0开始计数
      $(this).find("td:eq(3)").each(function () {
        source_total += parseFloat($(this).text());
      });
    });
    $('#source_total_price').text(source_total)
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
