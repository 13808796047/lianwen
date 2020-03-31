<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">订单流水号：{{ $order->orderid }}</h3>
    <div class="box-tools">
      <div class="btn-group float-right" style="margin-right: 10px">
        <a href="/admin/orders" class="btn btn-sm btn-default"><i class="fa fa-list"></i> 列表</a>
      </div>
    </div>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-md-10">
        <form class="form-horizontal" method="post" enctype="multipart/form-data"
              action="{{ route('admin.orders.receved',$order) }}">
          <input type="hidden" name="_method" value="PUT">
          @csrf
          <table class="table-bordered table">
            <tr>
              <td width="200">标题:</td>
              <td>{{ $order->title }}</td>
            </tr>
            <tr>
              <td>作者:</td>
              <td>{{ $order->writer }}</td>

            </tr>
            <tr>
              <td>字数:</td>
              <td>{{ $order->words }}</td>
            </tr>
            <tr>
              <td>价格:</td>
              <td>{{ $order->price }}</td>
            </tr>
            <tr>
              <td>状态</td>
              <td>
                <div class="form-group">
                  <select name="status" id="{{ $order->status }}" class="form-control">
                    <option value="0">待支付</option>
                    <option value="1">待检测</option>
                    <option value="2">排队中</option>
                    <option value="3">检测中</option>
                    <option value="4">检测完成</option>
                    <option value="5">暂停</option>
                    <option value="6">取消</option>
                    <option value="7">已退款</option>
                  </select>
                </div>
              </td>

            </tr>
            <tr>
              <td>重复率</td>
              <td>
                <div class="form-group">
                  <input type="text" class="form-control" id="rate" name="rate" value="{{ $order->rate }}">
                </div>
              </td>
            </tr>
            <tr>
              <td>支付详情</td>
              <td>在线支付:{{ $order->pay_type }}</td>
              <td>支付:</td>
              <td>{{ $order->pay_price }}</td>
              <td>单号:</td>
              <td>{{ $order->orderid }}</td>
              <td>支付时间:</td>
              <td>{{ $order->date_pay }}</td>
            </tr>
            <tr>
              <td>论文:</td>
              <td><a href="{{ route('admin.orders.download_paper',$order) }}" target="_blank">下载</a>(订单支付后才能下载论文,论文下载后订单状态自动转为检测中)
              </td>
              <td>
                实际路径:
              </td>
              <td>{{ $order->paper_path }}</td>
            </tr>
            <tr>
              <td>报告:</td>
              <td><a href="{{ route('admin.orders.download_report',$order) }}" target="_blank">下载</a></td>
              <td>
                重新上传报告:
              </td>
              <td>
                <input type="file" name="file">(上传报告后状态自动更新为'检测完成')
              </td>
            </tr>
          </table>


          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">提交</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    {{--    <table class="table table-bordered">--}}
    {{--      <tbody>--}}
    {{--      <tr>--}}
    {{--        <td>买家：</td>--}}
    {{--        <td>{{ $order->user->name }}</td>--}}
    {{--        <td>支付时间：</td>--}}
    {{--        <td>{{ $order->date_pay??'' }}</td>--}}
    {{--        <td>支付方式：</td>--}}
    {{--        <td>{{ $order->pay_type }}</td>--}}
    {{--        <td>支付渠道单号：</td>--}}
    {{--        <td>{{ $order->payid }}</td>--}}
    {{--        <td>订单金额：</td>--}}
    {{--        <td>￥{{ $order->pay_price }}</td>--}}
    {{--      </tr>--}}
    {{--      <tr>--}}
    {{--        <td>系统</td>--}}
    {{--        <td>{{$order->category->name}}</td>--}}
    {{--        <td>状态:</td>--}}
    {{--        <td>{{\App\Models\Enum\OrderEnum::getStatusName($order->status)}}</td>--}}
    {{--        <td>标题</td>--}}
    {{--        <td>{{ $order->title }}</td>--}}
    {{--        <td>作者</td>--}}
    {{--        <td>{{ $order->writer }}</td>--}}
    {{--        <td>发表时间</td>--}}
    {{--        <td>{{ $order->date_publish }}</td>--}}
    {{--      </tr>--}}
    {{--      <tr>--}}
    {{--        <td>字数:</td>--}}
    {{--        <td>{{ $order->words }}</td>--}}
    {{--        <td>价格:</td>--}}
    {{--        <td>{{ $order->price }}</td>--}}
    {{--        <td>报告路径</td>--}}
    {{--        <td>{{ $order->paper_path }}</td>--}}
    {{--        <td>下载报告:</td>--}}
    {{--        <td>{{ $order->report_path }}</td>--}}
    {{--        <td>重复率</td>--}}
    {{--        <td>{{ $order->rate }}</td>--}}

    {{--      </tr>--}}
    {{--      <tr>--}}
    {{--        <td> 来源</td>--}}
    {{--        <td>{{ $order->from }}</td>--}}
    {{--        <td>创建时间</td>--}}
    {{--        <td> {{ $order->created_at }}</td>--}}
    {{--        <td>API订单ID</td>--}}
    {{--        <td>{{ $order->api_orderid }}</td>--}}
    {{--      </tr>--}}
    {{--      <form action="{{ route('admin.orders.repeat_check',$order) }}" method="post">--}}
    {{--        <!-- 别忘了 csrf token 字段 -->--}}
    {{--        {{ csrf_field() }}--}}
    {{--        <tr>--}}
    {{--          <td>--}}
    {{--            <select name="type" id="">--}}
    {{--              <option value="upload_file">api手动上传文件</option>--}}
    {{--              <option value="create_order">api手动创建订单</option>--}}
    {{--              <option value="start_check">api手动开始检测</option>--}}
    {{--              <option value="get_order">api手动获取订单状态</option>--}}
    {{--              <option value="get_report">api手动获取报告</option>--}}
    {{--            </select>--}}
    {{--            <button type="submit" class="btn btn-success" id="create-order-btn">提交</button>--}}
    {{--          </td>--}}
    {{--        </tr>--}}
    {{--      </form>--}}
    {{--      </tbody>--}}
    {{--    </table>--}}
  </div>
</div>
