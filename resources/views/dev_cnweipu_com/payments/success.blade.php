@extends('domained::layouts.app')
@section('title','支付结果')
@section('styles')
  <!-- <link href="https://css.lianwen.com/css/public_c.css?v=2018v1" type="text/css" rel="stylesheet"/> -->
  <!-- <link href="https://css.lianwen.com/css/index_2017.css" type="text/css" rel="stylesheet"/> -->
  <link rel="stylesheet" href="{{asset('asset/css/index.css')}}">
  <link rel="stylesheet" href="{{asset('asset/css/check.css')}}">
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
              <div style="width:666px; float:right; text-align:left;"><font color="#0000FF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;联文检测已经收到您的付款，您现在可以关闭本页面。</font>将自动进行检测，检测成功后会通知您，请留意您的手机短信。您也可以在半个小时后打开
                <a class="blue" href="http://www.lianwen.com/report" target="_blank">www.lianwen.com/report </a>输入8位检测编号查询<br/>检测状态或者下载检测报告，如果超过2小时还没有检测完成请联系客服处理。
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
