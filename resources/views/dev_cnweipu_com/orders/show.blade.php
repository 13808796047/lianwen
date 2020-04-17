@extends('domained::layouts.app')
@section('title', '查看订单')
@section('styles')
  <link href="{{asset('asset/css/check.css')}}" rel="stylesheet"/>
  <link href="{{asset('asset/css/theme.css')}}" rel="stylesheet"/>
  <link href="{{asset('asset/css/font-awesome.min.css')}}" rel="stylesheet"/>
  <link href="{{asset('asset/css/alertify.css')}}" rel="stylesheet"/>
  <style>
    .curfont{
      font-size:16px;
    }
  </style>
@stop
@section('content')

{{--  <div class="container my-4 bg-white shadow">--}}
{{--    <div class="py-4">--}}
{{--      <h5 class="mb-4"><span class="text-xl text-primary mr-2"><i class="text-xl iconfont icon-file-done"></i></span>订单信息--}}
{{--      </h5>--}}
{{--    </div>--}}
{{--  </div>--}}
<div class="main clearfix">
	<div class="lbox fl">
		<div>
			<div class="cbox submit yh">
				<div class="down clearfix">
					<form action="{{route('payments.alipay',['order'=>$order->orderid])}}" method="get">
						<table class="mylist" style="line-height: 30px">
							<tr>
								<td width="149">
									<span>检测编号</span>
								</td>
								<td style="text-align: left;">
									<span>{{ $order->orderid }}</span>
								</td>
							</tr>
							<tr>
								<td width="">论文标题</td>
								<td style="text-align: left;">
									{{$order->title}}
								</td>
							</tr>
							<tr>
								<td width="">检测</td>
								<td style="text-align: left;">{{$order->category->name}}</td>
							</tr>
							<tr>
								<td>检测价格</td>
								<td style="text-align: left;">
									<span style="color:#FF5300; font-weight:bold;">￥{{$order->price}} 元</span>
									(总共{{$order->words}}字)
								</td>
							</tr>
							<tr bgcolor="#D0EAFF">
								<td colspan="2" align="center">
									<b>
										<font color="#BF2020">支付检测费用（请选择以下任意一种方式支付）</font>
									</b>
								</td>
							</tr>
							<tr style="display: none">
								<td class="td">②、淘宝订单号支付</td>
								<td class="td">
									<input type="checkbox" name="usetaobao" id="usetaobao" checked="checked" />
									<input type="text" style="width:300px;" class="txt" name="taobao" size="40" placeholder="使用在线支付请留空，多个订单号用,分隔"
									 value="" />
									<div class="tips">
										通过淘宝担保交易，检测完成后可在淘宝网评价，适合经常淘宝购物的同学使用。<span class="hl bgreen">不要等卖家发货</span>，记下淘宝订单号返回这里将单号填到上面的框框↑，再点击提交，如订单金额不足，需使用支付宝或微信支付差额。
									</div>
								</td>
							</tr>
							<tr style="display: none">
								<td class="td">③、代金券/秘钥支付</td>
								<td class="td">
									<input type="checkbox" name="usecoupon" id="usecoupon" checked="checked" />
									<!--<input type="hidden" name="coupon" class="txt"
                                                 placeholder="请输入8位秘钥/代金券密码，没有请留空" value="" style="width:300px;">-->
									<select name="coupon"> </select>
									<script>
										//let a = document.getElementById('djq');
                        //a.addEventListener('change', function () {

                        //});
                      </script>
									<div class="tips">
										持有手机版购买检测秘钥、或者赠送的代金券，输入后↑即可抵扣相应的检测金额，如秘钥/代金券不足以支付需使用支付宝或微信↓支付差额。
									</div>
								</td>
							</tr>
							<tr style="display: none">
								<td class="td">④、折扣券</td>
								<td class="td">
									<input type="checkbox" name="usedaze" id="usedaze" checked="checked" />
									<input type="text" name="daze" class="txt" placeholder="请输入8位折扣券密码，没有请留空" value="" style="width:300px;" />
									<a href="./zt/dazhe.html" target="_blank" style="color:#0000FF">点击获取折扣券</a>
									<div class="tips">
										<font color="#ff0000">折扣券需配合“⑤在线支付”方可享受折扣</font>，使用后享受全平台检测费九折优惠(知网检测九五折)。
									</div>
								</td>
							</tr>
							<tr>
								<td class="td">
									在线支付<font color="#FF0004">(推荐)</font>
								</td>
								<td class="td">
									<div style="display:flex;align-items: center">
										<input type="radio" name="paytype" value="alipay" checked="checked" />
										<img src="{{asset('asset/images/alipay.png')}}" style="margin-left:17px;" />
									</div>
									&nbsp;&nbsp;
									<!--<label><input type="radio" name="paytype" value="tenpay" > <img src="./asset/imgs/tenpay.png" /></label> -->
									<div style="display:flex;align-items: center">
										<input type="radio" name="paytype" value="wxpay" />
										<img src="{{asset('asset/images/wxpay.png')}}" style="width:99px;margin-left:17px;" />
									</div>
									<div class="tips">
										直接使用支付宝或者微信支付，即时返回支付结果，方便快捷，推荐使用。
									</div>
								</td>
							</tr>
						</table>
						<a type="button" id="bottonsubmit" style="height:33px; margin-left:20px; margin-left:320px;" href="{{ route('payments.alipay', ['order' => $order->id])}}"
						 class="btn btn-primary btn-sm sbtn">提交</a>
						<a type="button" id="btn-wechat" style="height:33px; margin-left:20px; margin-left:320px;display: none" href="javascript:;"
						 class="btn btn-primary btn-sm sbtn">提交</a>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="rbox fr">
		<div style="background:#fff;padding:30px">
			<span class="hl bgreen" style="display:block;text-align:center;">温馨提示</span>
			<p style="text-indent: 2em;">
				1、如果您的可用余额、代金券/秘钥面值与实际值不符，因为您有未完成的提现申请或未完成的检测订单，造成了相应金额的锁定。
			</p>
			<p style="text-indent: 2em;">
				2、如果您勾选了余额支付和代金券/秘钥支付，将优先使用代金券/秘钥支付，余下部分才从账户余额支付。
			</p>
		</div>
	</div>
</div>

<!--/.fluid-container-->

@endsection
@section('scripts')
  <script>
    $(document).ready(function () {
      $('.navbar>div').removeClass('container').addClass('container-fluid')
      $('#headerlw').addClass('curfont')
      $('#lwfooter').removeClass('absolute');
      $("input[name='paytype']").change(() => {
        $('#bottonsubmit').toggle();
        $('#btn-wechat').toggle();
      })
      // 微信支付按钮事件
      $('#btn-wechat').click(function () {
        swal({
          // content 参数可以是一个 DOM 元素，这里我们用 jQuery 动态生成一个 img 标签，并通过 [0] 的方式获取到 DOM 元素
          content: $('<img src="{{ route('payments.wechat', ['order' => $order->id]) }}" />')[0],
          // buttons 参数可以设置按钮显示的文案
          buttons: ['关闭', '已完成付款'],
        })
          .then(function (result) {
            // 如果用户点击了 已完成付款 按钮，则重新加载页面
            if (result) {
              location.href = '{{ route('payments.wechat.return',$order) }}';
            }
          })
      });
    });

    // $(function () {
    //   setInterval("checkpaied()", 1000);
    //   $("#usedeposit").click(function () {
    //     if ($(this).is(":checked")) {
    //       $("#depositinfo").show();
    //     } else {
    //       $("#depositinfo").hide();
    //     }
    //   });
    // });
  </script>
@stop
