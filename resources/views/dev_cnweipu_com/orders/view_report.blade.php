@extends('domained::layouts.app')
@section('title','查看报告')
@section('styles')
  <link rel="stylesheet" href="{{asset('asset/css/check.css')}}">

  <style>
    .card-body p {
      text-indent: 2em !important;
    }

  </style>

@stop
@section('content')
  <div class="main clearfix">
      <div class="lbox fl">
        <div>
          <div class="card-body">
            <div class="card-title">
              <h2 class="text-3xl text-center">{{ $order->title }}</h2>
              <div class="info">
                <span>作者:</span>
                &emsp;
                <span>{{ $order->writer }}</span>
                &emsp;
                <span>提交时间:</span>
                &emsp;
                <span>{{ $order->created_at }}</span>
                &emsp;
                <span>重复率:</span>
                &emsp;
                <span>{{ $order->rate }}</span>
                &emsp;
                <a href="{{ route('orders.download',['orderid'=>$order->orderid]) }}"
                   class="bg-blue-500 px-2 rounded-sm text-white">下载报告</a>
                <span class="bg-blue-500 px-2 rounded-sm text-white" style="margin-left:13px" id="qrcode">生成二维码</span>
              </div>
            </div>
            <!-- Modal -->
  <div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
        <label for="validationTooltipUsername" class="col-form-label">请填写重复率</label>
        <input type="number" class="form-control" id="recipient-name" min="1" max="100" step="0.01" required>
        <div>
          请填写正确值(0-100)
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
          <button type="button" class="btn btn-primary">确定</button>
        </div>
      </div>
    </div>
  </div>
          <!-- Modal-end -->
            @if($order->report->content)
              {!! $order->report->content !!}
            @else
              <!-- <h2 class="text-center text-5xl">暂无内容!!!!</h2> -->
              <iframe src="https://wap.lianwen.com/dev/weipu.pdf" width="100%" height="650"></iframe>
            @endif
          </div>
        </div>
      </div>
      <div class="rbox fr">
        <div class="bg-white" style="padding:20px">
        <b>1、检测结果是否准确？</b>
        <p>如果你们学校也是用万方检测，那结果是一致的。同一个的系统、同样的比对库、同样的算法，所以只要在本系统提交的内容和学校的一致，那检测结果是一致的。</p>
        <b>2、检测需要多少时间？</b>
        <p>正常情况，万方检测需要10分钟左右，高峰期可能会延迟，但不会超过1个小时，如果长时间未出结果请联系客服微信：cx5078解决。</p>
        <b>3、论文上传之后安全吗？</b>
        <p>本系统有明确的条文规定并遵守严格的论文保密规定，对所有用户提交的送检文档仅做检测分析，绝不保留全文，承诺对用户送检的文档不做任何形式的收录和泄露。</p>
        <b>4、提交以后能不能退款？</b>
        <p>此系统一旦提交，系统开始检测后，即产生消费，无法退款！</p>
        <b>5、检测内容范围？</b>
        <p>系统不检测文章中的封面、致谢、学校(需要替换成"X")等个人信息，请在提交前自己删除，若提交后由系统自动删除时出现的任何问题责任自负！</p>
        <b>6、检测时作者需要填吗？</b>
        <p>在提交检测的文章中，引用了一些内以前自己所写的内容并且被小论文系统文献库收录，需要在此次检测中排除这些；则会有“去除本人已发表文献复制比”的结果。</p>
        </div>
      </div>
  </div>
@stop
@section('scripts')
  <script !src="">
    $(function () {
      $("#qrcode").click(function(){
          let order = {!!$order!!};
          console.log(order,order.rate)
          //判断是否存在重复率
          if(order.rate==0.00){
            $('#exampleModal').modal('show')
          }else{
            swal({
              // content 参数可以是一个 DOM 元素，这里我们用 jQuery 动态生成一个 img 标签，并通过 [0] 的方式获取到 DOM 元素
              content: $(`<img src='/orders/${order.id}/qrcode' style="display: block;margin: 0 auto;"/><p>分享到朋友圈</p>`)[0],
            })
          }
      })

      $('.navbar>div').removeClass('container').addClass('container-fluid')
      $('#headerlw').addClass('curfont')
    })
  </script>
@stop
