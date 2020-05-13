@extends('domained::layouts.app')
@section('title','订单支付')
@section('styles')
  <!-- <link href="https://css.lianwen.com/css/public_c.css?v=2018v1" type="text/css" rel="stylesheet"/>
  <link href="https://css.lianwen.com/css/index_2017.css" type="text/css" rel="stylesheet"/> -->
  <!-- <link rel="stylesheet" href="{{asset('asset/css/index.css')}}"> -->
  <link rel="stylesheet" href="{{asset('asset/css/check.css')}}">
  <link href="{{asset('asset/css/theme.css')}}" rel="stylesheet"/>
  <style>
    .curfont {
      font-size: 16px;
    }
    del { background: #FF4040; }
    ins { background: #00ff21;text-decoration:none; }
  </style>
@stop
@section('content')
    <!--左边导航-->
    <div class="main clearfix" id="jcafter" style="flex:1">
      <div class="lbox fl">
      <div>
			<div class="cbox submit yh">
				<div class="down clearfix">
						<table class="mylist" style="line-height: 30px">
							<tr>
								<td width="149">
									<span>购买次数</span>
								</td>
								<td style="text-align: left;">
									<span>{{$recharge->amount}}</span>
								</td>
							</tr>
							<tr>
								<td width="">价格</td>
								<td style="text-align: left;">
									￥{{ $recharge->total_amount}}
								</td>
							</tr>
							<tr bgcolor="#D0EAFF">
								<td colspan="2" align="center">
									<b>
										<font color="#BF2020">支付检测费用（请选择以下任意一种方式支付）</font>
									</b>
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
						<a type="button" id="bottonsubmit" style="height:33px; margin-left:20px; margin-left:320px;" href="javascript:;"
						 class="btn btn-primary btn-sm sbtn">提交</a>
						<a type="button" id="btn-wechat" style="height:33px; margin-left:20px; margin-left:320px;display: none" href="javascript:;"
						 class="btn btn-primary btn-sm sbtn">提交</a>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
    </div>
    <!--右边内容-->
    <div class="rbox fr" style="min-height:900px;">
      <div class="box">
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
  </div>
@stop
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
    });
  </script>
@stop
