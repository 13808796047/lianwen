@extends('domained::layouts.app')
@section('title','支付结果')
@section('styles')
  <!-- <link href="https://css.lianwen.com/css/public_c.css?v=2018v1" type="text/css" rel="stylesheet"/>
  <link href="https://css.lianwen.com/css/index_2017.css" type="text/css" rel="stylesheet"/> -->
  <!-- <link rel="stylesheet" href="{{asset('asset/css/index.css')}}"> -->
  <link rel="stylesheet" href="{{asset('asset/css/check.css')}}">
  <style>
   .lwjc_title{overflow:hidden; padding:40px;border-bottom:solid 1px #eeeeee; }
   .lwjc_title h4{font-size:28px; padding-left: 115px!important; height:80px!important; color:#666666; font-size:26px; line-height:96px; background:url(../images/icon_eye.png) no-repeat; float:left; padding-left:105px;}
   .lwjc_title h3{ color:#666666;font-size:26px; line-height:36px; float:left;}
   .lwjc_title .nav a{width:90px; height:34px; background-color:#0083cd; display:block; text-align:center; line-height:34px; color:#fff; float:right; margin-top:32px;}
   .lwjc_title p{ float:left; color:#666666; font-size:14px; margin-top:10px; text-indent:2em; line-height:28px;}
   .result{overflow:hidden; padding:80px 40px; padding-bottom:0px; font-size:14px; line-height:28px;}
   .result h3{ color:#666666; font-size:26px; line-height:56px; float:left;}
   .cbox{ padding:30px; font-size:14px;}
   .submit dl{ clear:both; width:738px; margin:0px auto; padding:12px;}
   .submit dt{ float:left; padding:5px; padding-right:20px;}
   .submit dd{ float:left; text-align:left;}
   .down{ width:738px; margin:0 auto;}
   table.mylist {
	border: 1px solid #CDCDCD;
	border-collapse: collapse;
	padding: 2px;
	width: 756px;
	margin: 5px 0;
}

.mylist td, .mylist th {
	border: 1px solid #CDCDCD;
	padding: 8px 5px;
	text-align: center;
}
.mylist .td{ text-align:left !important; padding-left:10px !important; padding-top:15px !important; padding-top:15px !important;}
.tips{ font-size:12px; color:#777; text-indent:1.5em; line-height:23px; padding-top:5px;}
.text-error {
  color: #b94a48;
}
   .submit .txt{ padding:5px 10px; width:168px;}
   .yh0{font-family: Microsoft YaHei,"微软雅黑", STXihei,"华文细黑",SimSun,"宋体", Heiti,"黑体",sans-serif;}
   .submit .radio input{ padding-left:0;}
   .submit .text{ border:#C8C4C4 solid 1px; margin-top:12px; padding:11px; margin-bottom:10px; width:600px;}
   .result_no a{width:90px; height:34px; background-color:#0083cd; display:block; text-align:center; line-height:34px; color:#fff; float:right; margin-top:10px; font-size:12px;}
   .success { background:url('https://css.lianwen.com/images/success.png') no-repeat; margin-top:25px; margin-left:125px; width:111px; height:111px;float:left; display:inline-block;}
  </style>
@stop
@section('content')
      <!--左边导航-->
      <!--右边内容-->
    <div class="main clearfix">
    <div class="lbox fl">
      <div class="con_right">
        <div class="lwjcBox">
          <div class="lwjc">
            <div class="result clearfix">
              <i class="success"></i>
              <div style="width:666px; float:right; text-align:right;">
                <div class="nav"></div>
                <h3>{{$msg}}</h3>
              </div>
              <div style="width:666px; float:right; text-align:left;"><font color="#0000FF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;系统已经收到您的付款，论文正在检测中，预计需要10分钟左右。</font>您记下报告查询网址后可以关闭本页面，如长时间未收到检测报告请联系客服微信：cx5078处理。
                <br/>报告查询网址：<a class="blue" href="https://wanfang.lianwen.com" target="_blank">https://wanfang.lianwen.com</a>
              </div>
            </div>

            <div class="cbox submit yh">
              <div class="down clearfix">


                <table class="mylist">
                  <tr>
                    <td><span class="hl bred">检测编号（请牢记）</span></td>
                    <td><span class="hl bgreen">{{$order->orderid}}</span></td>
                  </tr>
                  <tr>
                    <td>检测</td>
                    <td>{{$order->category->name}}</td>
                  </tr>
                  <tr>
                    <td>标题</td>
                    <td>《{{$order->title}}》</td>
                  </tr>
                  <tr>
                    <td>字数</td>
                    <td>{{$order->words}}</td>
                  </tr>
                  <tr>
                    <td>价格</td>
                    <td style="color:#FF5300; font-weight:bold;">{{ $order->pay_price }} 元</td>
                  </tr>
                  <tr>
                    <td>状态</td>
                    <td><span class="hl bgreen">{{ \App\Models\Enum\OrderEnum::getStatusName($order->status) }}</span>
                    </td>
                  </tr>
                  <tr>
                    <td>时间</td>
                    <td>{{ $order->date_pay }}</td>
                  </tr>
                </table>


                <div class="clearfix"></div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="rbox fr">
      <div class="tit">在线客服</div>
      <div class="box">客服微信:cx5078</div>
      <div class="box mt10">
        <b>1、怎么选择适合自己的论文检测系统？</b>
        <p>只有使用和学校相同的数据库，才能保证重复率与学校、杂志社100%一致：</br>论文初次修改可使用联文检测、PaperPass，定稿再使用与学校一样的系统。</p>
        <b>2、检测要多长时间，报告怎么还没出来？</b>
        <p>正常检测20分钟左右，毕业高峰期，服务器检测压力大，时间会有延长，请大家提前做好时间准备。超过2小时没出结果可以联系客服处理！</p>
        <b>3、同一篇论文可以多次检测吗？？</b>
        <p>本站不限制论文检测次数，但检测一次需支付一次费用。</p>
        <b>4、检测报告有网页版、pdf格式的吗？</b>
        <p>检测完成后会提供网页版和pdf格式的检测报告，报告只是格式不同，重复率都一样的。</p>

      </div>
    </div>
    </div>

@stop
