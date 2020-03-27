<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">订单流水号：{{ $order->orderid }}</h3>
    <div class="box-tools">
      <div class="btn-group float-right" style="margin-right: 10px">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i> 列表</a>
      </div>
    </div>
  </div>
  <div class="box-body">
    <table class="table table-bordered">
      <tbody>
      <tr>
        <td>买家：</td>
        <td>{{ $order->user->name }}</td>
        <td>支付时间：</td>
        <td>{{ $order->date_pay??'' }}</td>
        <td>支付方式：</td>
        <td>{{ $order->pay_type }}</td>
        <td>支付渠道单号：</td>
        <td>{{ $order->payid }}</td>
      </tr>
      <tr>
        <td>订单金额：</td>
        <td>￥{{ $order->pay_price }}</td>
      </tr>
      <form action="{{ route('admin.orders.repeat_check',$order) }}" method="post">
        <!-- 别忘了 csrf token 字段 -->
        {{ csrf_field() }}
        <tr>
          <td>
            <select name="type" id="">
              <option value="upload_file">api手动上传文件</option>
              <option value="create_order">api手动创建订单</option>
              <option value="start_check">api手动开始检测</option>
              <option value="get_order">api手动获取订单状态</option>
              <option value="get_report">api手动获取报告</option>
            </select>
            <button type="submit" class="btn btn-success" id="create-order-btn">提交</button>
          </td>
        </tr>
      </form>
      </tbody>
    </table>
  </div>
</div>
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
