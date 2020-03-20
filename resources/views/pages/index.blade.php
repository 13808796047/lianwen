@extends('layouts.app')
@section('title', '首页')
@section('styles')
  <link href="{{asset('asset/css/index.css')}}" rel="stylesheet"/>
  <style>
    .is_invalid {
      border-color: red;
    }

    .invalid_feedback {
      width: 100%;
      margin-top: 0.25rem;
      font-size: 80%;
      color: #e3342f;
    }

    .login-banner {
      background-image: url(https://www.lianwen.com/images/bg0.jpg);
      background-color: rgb(40, 73, 123);
    }
  </style>
@stop
@section('content')
  <!-- main轮播登陆块 -->
  <div class="login-banner">
    <div class="login-banner-box">

      <div style="left:18%; top:88px;position: absolute;">
        <img src="{{asset('asset/images/bg2i.png')}}" width="100%"/>
      </div>
      <div class="login-box">
        @guest


          <div class="header">
            <ul id="loginTitle">
              <li class="banner-li li-current" id="zh">账号登陆</li>
              <li class="banner-li " id="wx">微信登陆</li>

            </ul>
          </div>
          <div class="box-main">

            <div
              class="ch-input-wrap listbox remove"
              id="zhlogin"

            >
              @include('shared._messages')
              <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-item">

                  <div class="hd"> <span id="logerror" class="wrong c-red"
                                         style="color:red"
                    >* <em></em
                      ></span>用户名：
                  </div>
                  <div class="input-div">
                    <input
                      class="input"
                      name="account"
                      id="name"
                      type="text"
                      placeholder="用户名或手机号"
                      autocomplete="off"
                      value="{{old('account')}}"
                    />
                    <span class="invalid_feedback" role="alert">
                  </span>
                  </div>

                </div>
                <div class="form-item">
                  <div class="hd"> <span id="logerror" class="wrong c-red"
                                         style="color:red"
                    >* <em></em
                      ></span>密 码：
                  </div>
                  <div class="input-div">
                    <input
                      class="input @error('phone') is_invalid @enderror"
                      name="password"
                      id="password"
                      type="password"
                      placeholder="请输入密码"
                      autocomplete="new-password"
                      value="{{old('password')}}"
                    />
                    <span class="invalid_feedback" role="alert">
                  </span>
                  </div>
                </div>

                <div class="form-item">
                  <div class="agreement">
                    <input
                      id="chkLoginType"
                      type="checkbox"
                      name="remember"
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
            <div class="content listbox " style="display: none" id="wxlogin">
              <div class="tit">
                <p>微信扫一扫 享免费检测</p>
              </div>
              <div class="codeimg">
                <img id="{{qrcodeUrl}}" src="" alt="更新二维码"/>
              </div>

              <div class="box-word">无需注册，一键登录</div>
            </div>
          </div>


        @else
          <div class="box-main">
            <div class="content listbox">
              <p class='logintitle'>欢迎你</p>
              <p class='loginname'>{{Auth::user()->username}}</p>
              <img src='https://css.lianwen.com/images/head.jpg' class='loginimg'>
              <a href='javascript:;' id="logoutBtn" class='exit'>退出</a>
            </div>
          </div>
        @endguest
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
@section('scripts')
  <script>
    $(function () {
      $('#btnSubmit').click(() => {
        axios.post('{{ route('login') }}', {
          account: $('#name').val(),
          password: $('#password').val()
        }).then(res => {
          location.reload();
        }).catch(err => {
          if (err.response.status == 422) {
            $.each(err.response.data.errors, (field, errors) => {
              if (field == 'account') {
                $('#name').addClass('is_invalid')
                $('#name+span').html('<strong>' + errors[0] + '</strong>');
              } else {
                $('#password').addClass('is_invalid')
                $('#password+span').html('<strong>' + errors[0] + '</strong>');
              }
            })
          }
        });
      });
      $('#logoutBtn').click(() => {
        axios.post('{{route('logout')}}').then(res => {
          location.reload();
        })
      });
      // Tab切换
      $(".banner-li").click(function () {
        $(this)
          .addClass("li-current")
          .siblings()
          .removeClass("li-current");
        let liIndex = $(this).index();
        $(".listbox")
          .eq(liIndex)
          .css("display", "block")
          .siblings(".listbox")
          .css("display", "none");
      });
    });
  </script>
@stop
