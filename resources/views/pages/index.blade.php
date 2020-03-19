@extends('layouts.app')
@section('title', '首页')
@section('styles')
  <link href="{{asset('asset/css/index.css')}}" rel="stylesheet"/>
@stop
@section('content')
  <!-- main轮播登陆块 -->
  <div class="login-banner">
    <div class="login-banner-box">
      <div style="left:18%; top:88px;position: absolute;">
        <img src="{{asset('asset/images/bg2i.png')}}" width="100%"/>
      </div>
      <div class="login-box">
        <div class="header">
          <ul id="loginTitle">
            <li class="banner-li li-current" id="wx">微信登陆</li>
            <li class="banner-li" id="zh">账号登陆</li>
          </ul>
        </div>
        <div class="box-main">
          <div class="content listbox" id="wxlogin">
            <div class="tit">
              <p>微信扫一扫 享免费检测</p>
            </div>
            <div class="codeimg">
              <img id="login_mpweixin_img" src="" alt="更新二维码"/>
            </div>

            <div class="box-word">无需注册，一键登录</div>
          </div>
          <div
            class="ch-input-wrap listbox remove"
            id="zhlogin"
            style="display: none"
          >
            <form action="./user/login" method="post" class="form">
              <div class="form-item">
                  <span id="logerror" class="wrong c-red" style="display:none;"
                  >* <em></em
                    ></span>
                <div class="hd">用户名：</div>
                <div class="input-div">
                  <input
                    class="input"
                    name="name"
                    id="name"
                    type="text"
                    placeholder="用户名或手机号"
                    autocomplete="off"
                  />
                </div>
              </div>
              <div class="form-item">
                <div class="hd">密 码：</div>
                <div class="input-div">
                  <input
                    class="input"
                    name="password"
                    id="password"
                    type="password"
                    placeholder="密码"
                    autocomplete="new-password"
                  />
                </div>
              </div>

              <div class="form-item">
                <div class="agreement">
                  <input
                    id="chkLoginType"
                    type="checkbox"
                    name="chkLoginType"
                  />
                  记住密码
                </div>
              </div>
              <div class="form-item">
                <input
                  id="btnSubmit"
                  type="button"
                  class="btn-login"
                  value="登 录"
                  onclick="getLogin()"
                />
              </div>

              <div class="form-item">
                还没有账号？<a
                  href="javascript:void(0)"
                  onclick="window.location.href='/register'"
                >立即注册</a
                >
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- 文字内容 -->
  <div class="main">
    <div class="main-wrap">
      <div class="item fl first">
        <h4 class="ind1_txt">专业</h4>
        <div class="text">
          不仅提供查重服务，更是提供专业的全套论文解决方案，为你解除论文烦恼。
        </div>
      </div>
      <div class="item fl">
        <h4 class="ind1_txt">省心</h4>
        <div class="text">
          各种论文问题均可一键解决，省心，省力，极其方便的解决论文痛点
        </div>
      </div>
      <div class="item fl">
        <h4 class="ind1_txt">安全</h4>
        <div class="text">
          全站https协议传输，基于阿里云OSS文档上传，报告支持密码加密，安全无痕迹
        </div>
      </div>
    </div>
  </div>
@stop
