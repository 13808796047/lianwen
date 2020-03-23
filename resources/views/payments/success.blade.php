@extends('layouts.app')
@section('title','支付结果')
@section('styles')
  <link href="https://css.lianwen.com/css/public_c.css?v=2018v1" type="text/css" rel="stylesheet"/>
  <link href="https://css.lianwen.com/css/index_2017.css" type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{asset('asset/css/index.css')}}">
@stop
@section('content')
  <div class="contentBox">
    <div class="con">
      <!--左边导航-->
      <div class="con_left" id="fixedMenu">
        <ul class="sidebar_nav">
          <li class="has_xiala">
            <a>客服中心</a>
          </li>
          <li>
            <table class="kefu" border="0" cellspacing="0" cellpadding="0">
              <tbody>
              <tr>
                <td scope="col" width="50%">客服①：
                  <a target="_blank" href="https://wpa.qq.com/msgrd?v=3&uin=318993001&site=qq&menu=yes">
                    <img border="0" src="https://pub.idqqimg.com/qconn/wpa/button/button_111.gif" alt="点击这里给我发消息"
                         title="点击这里给我发消息"/></a></td>
                <td scope="col" width="50%">客服②：
                  <a target="_blank" href="https://wpa.qq.com/msgrd?v=3&uin=1391581760&site=qq&menu=yes">
                    <img border="0" src="https://pub.idqqimg.com/qconn/wpa/button/button_111.gif" alt="点击这里给我发消息"
                         title="点击这里给我发消息"/></a></td>
              </tr>
              <tr>
                <td>客服③：
                  <a target="_blank" href="https://wpa.qq.com/msgrd?v=3&uin=790051001&site=qq&menu=yes">
                    <img border="0" src="https://pub.idqqimg.com/qconn/wpa/button/button_111.gif" alt="点击这里给我发消息"
                         title="点击这里给我发消息"/></a></td>
                <td>投&emsp;诉：
                  <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=813338&site=qq&menu=yes">
                    <img border="0" src="https://pub.idqqimg.com/qconn/wpa/button/button_111.gif" alt="点击这里给我发消息"
                         title="点击这里给我发消息"/></a></td>
              </tr>
              <tr>
                <td>旺&emsp;旺：<a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=%E5%85%B0%E8%89%B2%E5%B0%8F%E7%B2%BE%E7%81%B5
&site=cntaobao&s=1&groupid=0&charset=utf-8"><img border="0" src="https://amos.alicdn.com/online.aw?v=2&uid=%E5%85%B0%E8%89%B2%E5%B0%8F%E7%B2%BE%E7%81%B5
&site=cntaobao&s=1&charset=utf-8" alt="点这里给我发消息"/></a>
                </td>
                <td>网&emsp;页：
                  <a target="_blank" href="http://p.qiao.baidu.com/cps/chat?siteId=6477403&userId=10092912">
                    <img border="0" src="https://css.lianwen.com/images/sq.png" width="78" height="22" alt="点击这里给我发消息"
                         title="点击这里给我发消息"/></a></td>
              </tr>
              <tr>
                <td class="tel" colspan="2">&#x260E;服务热线: 400-823-8869</td>
              </tr>
              <tr>
                <td colspan="2" class="wx">
                  <img src="https://css.lianwen.com/images/weixin.png" width="100" height="100">
                  <br/>扫一扫，微信沟通
                </td>
              </tr>
              </tbody>
            </table>
          </li>
          <li class="has_xiala">
            <a>使用帮助</a>
          </li>
          <li class="dropDown">
            <ul class="log_res">
              <li>
                <a href="/zt/system"><span class="a_lwfb"></span>如何选择检测？</a>
              </li>
              <li>
                <a href="/help#reg"><span class="a_lwfb"></span>需要注册账号吗？</a>
              </li>
              <li>
                <a href="/help#pay"><span class="a_lwfb"></span>如何支付检测费用？</a>
              </li>
              <li>
                <a href="/help#result"><span class="a_lwfb"></span>检测结果准确吗？</a>
              </li>
              <li>
                <a href="/help#safe"><span class="a_lwfb"></span>我的论文会不会被记录？</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>            <!--右边内容-->
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
                    <td><span class="hl bgreen">JC17FE78</span></td>
                  </tr>
                  <tr>
                    <td>检测</td>
                    <td>维普编辑部版</td>
                  </tr>
                  <tr>
                    <td>标题</td>
                    <td>《我国体育赛事品牌资产生成机理与培育路径研究》</td>
                  </tr>
                  <tr>
                    <td>字数</td>
                    <td>13581</td>
                  </tr>
                  <tr>
                    <td>价格</td>
                    <td style="color:#FF5300; font-weight:bold;">42.00 元</td>
                  </tr>
                  <tr>
                    <td>状态</td>
                    <td><span class="hl bgreen">检测完成</span>
                    </td>
                  </tr>
                  <tr>
                    <td>时间</td>
                    <td>2020-03-14 21:27:06</td>
                  </tr>
                </table>


                <div class="clearfix"></div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@stop
