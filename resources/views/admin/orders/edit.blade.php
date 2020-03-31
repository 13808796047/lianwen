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

    <form class="form-horizontal">
      <table class="table table-bordered">
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
              <select name="status" id="" class="form-control">
                <option value="0" {{ $order->status==0?'selected':'' }} }}>待支付</option>
                <option value="1" {{ $order->status==1?'selected':'' }} }}>待检测</option>
                <option value="2" {{ $order->status==2?'selected':'' }} }}>排队中</option>
                <option value="3" {{ $order->status==3?'selected':'' }} }}>检测中</option>
                <option value="4" {{ $order->status==4?'selected':'' }} }}>检测完成</option>
                <option value="5" {{ $order->status==5?'selected':'' }} }}>暂停</option>
                <option value="6" {{ $order->status==6?'selected':'' }} }}>取消</option>
                <option value="7" {{ $order->status==7?'selected':'' }} }}>已退款</option>
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
          <td><a href="{{ $order->paper_path }}" target="_blank">下载</a>(订单支付后才能下载论文,论文下载后订单状态自动转为检测中)
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
            <input type="file" name="file" id="file">(上传报告后状态自动更新为'检测完成')
          </td>
        </tr>
      </table>


      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="button" class="btn btn-primary" id="btnSubmit">提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script !src="">

  $(() => {

    $('#btnSubmit').click(() => {
      var formData = new FormData();
      formData.append('file', $('#file')[0].files[0]); // 固定格式
      formData.append('status', $("select[name='status']").val()); // 固定格式
      formData.append('rate', $("input[name='rate']").val()); // 固定格式
      formData.append('_token', LA.token); // 固定格式
      $.ajax({
        url: '{{ route('admin.orders.receved',$order) }}',
        type: 'POST',
        data: formData,
        contentType: false,
// 告诉jQuery不要去设置Content-Type请求头
        processData: false,
// 告诉jQuery不要去处理发送的数据
      }).then(res => {
        console.log(res)
      })
    })
  })
</script>
