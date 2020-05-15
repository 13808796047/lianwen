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
          <label for='title'>标题</label>
          <input type="text" class="form-control" value="{{ $order->title }}" disabled>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-1 mb-3">
          <label for='title'>作者</label>
          <input type="text" class="form-control" value="{{ $order->writer }}" disabled>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-1 mb-3">
          <label for='title'>字数</label>
          <input type="text" class="form-control" value="{{ $order->words }}" disabled>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-1 mb-3">
          <label for='title'>价格</label>
          <input type="text" class="form-control" value="{{ $order->price }}" disabled>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-1 mb-3">
          <label for='title'>重复率</label>
          <input type="text" class="form-control" value="{{ $order->rate }}">
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-1 mb-3">
          <label for='title'>状态</label>
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
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-1 mb-3">
          <label for='title'>支付方式</label>
          <input type="text" class="form-control" value="{{ $order->pay_type }}">
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-1 mb-3">
          <label for='title'>支付金额</label>
          <input type="text" class="form-control" value="{{ $order->pay_price }}">
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-1 mb-3">
          <label for='title'>支付时间</label>
          <input type="text" class="form-control" value="{{ $order->date_pay }}">
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-2">
          <label for='title'>论文</label>
          <a class="btn btn-danger" href="{{ $order->paper_path }}" target="_blank">下载</a>(订单支付后才能下载论文)
        </div>
        <div class="col-md-4">
          <label for='title'>实际路径</label>
          <a class="btn-danger">{{ $order->paper_path }}</a>
        </div>
        <div class="col-md-2">
          <label for='title'>论文</label>
          <a class="btn btn-danger" href="{{ route('admin.orders.download_report',$order) }}" target="_blank">下载</a>
        </div>
        <div class="col-md-4 mb-3">
          <label for='title'>重新上传报告</label>
          <input type="file" name="file" id="file" class="form-control">(上传报告后状态自动更新为'检测完成')
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
      </div>


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
