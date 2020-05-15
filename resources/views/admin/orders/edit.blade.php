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

    <form class="form-horizontal" enctype="multipart/form-data" id="order-form" method="POST"
          action="{{ route('admin.orders.receved',$order) }}">
      @csrf
      <div class="form-row">
        <div class="col-md-4 mb-3">
          <label for='title'>First name</label>
          <input type="text" class="form-control" value="{{ $order->title }}" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="validationServer02">Last name</label>
          <input type="text" class="form-control is-valid" id="validationServer02" value="Otto" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="validationServerUsername">Username</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroupPrepend3">@</span>
            </div>
            <input type="text" class="form-control is-invalid" id="validationServerUsername"
                   aria-describedby="inputGroupPrepend3" required>
            <div class="invalid-feedback">
              Please choose a username.
            </div>
          </div>
        </div>
      </div>
      <table class="table  custom-data-table dataTable">
        <tr>
          <td>标题:</td>
          <td>{{ $order->title }}</td>

          <td>作者:</td>
          <td>{{ $order->writer }}</td>


          <td>字数:</td>
          <td>{{ $order->words }}</td>

          <td>价格:</td>
          <td>{{ $order->price }}</td>
        </tr>
        <tr>
          <td>状态</td>
          <td width="100px">
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
          <td>重复率</td>
          <td width="150px">
            <div class="form-group">
              <input type="text" class="form-control" id="rate" name="rate" value="{{ $order->rate }}">
            </div>
          </td>

          <td>支付方式</td>
          <td>在线支付:{{ $order->pay_type }}</td>
          <td>支付:</td>
          <td>{{ $order->pay_price }}</td>
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
          <button type="submit" class="btn btn-primary" id="btnSubmit">提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script !src="">
  Dcat.ready(function () {
    // ajax表单提交

    $('#order-form').form({

      success: function (data) {
        // data 为接口返回数据
        if (!data.status) {
          Dcat.error(data.message);

          return false;
        }

        Dcat.success(data.message);

        if (data.redirect) {
          Dcat.reload(data.redirect)
        }

        // 中止后续逻辑（默认逻辑）
        return false;
      },
      error: function (response) {
        // 当提交表单失败的时候会有默认的处理方法，通常使用默认的方式处理即可
        var errorData = JSON.parse(response.responseText);

        if (errorData) {
          Dcat.error(errorData.message);
        } else {
          console.log('提交出错', response.responseText);
        }

        // 终止后续逻辑执行
        return false;
      },
    });

  });
</script>
