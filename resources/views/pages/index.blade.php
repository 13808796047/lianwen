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


          {{--          <div class="header">--}}
          {{--            <ul id="loginTitle">--}}
          {{--              <li class="banner-li li-current" id="zh">账号登陆</li>--}}
          {{--              --}}{{--              <li class="banner-li " id="wx">微信登陆</li>--}}

          {{--            </ul>--}}
          {{--          </div>--}}
          <div class="box-main">

            <div class="w-full max-w-xs">
              <form class="bg-white rounded px-8 pt-6 pb-8 mb-4">
                <div>
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    用户名:
                  </label>
                  <input
                    class="appearance-none border rounded w-full py-2 px-3 mb-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="name"
                    id="name" type="text" placeholder="请输入手机号码">
                  <p class="text-red-500 text-xs italic "></p>
                </div>
                <div class="mb-2">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    密码:
                  </label>
                  <input
                    class="appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    name="password"
                    id="password" type="password" placeholder="请输入密码">
                  <p class="text-red-500 text-xs italic "></p>
                </div>
                <div class="flex items-center justify-between">
                  <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 w-full px-4 rounded focus:outline-none focus:shadow-outline"
                    type="button" id="btnSubmit">
                    登录
                  </button>

                </div>
                <p class=" text-gray-500 text-xs mt-4">
                  <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                     href="{{route('register')}}">
                    还没有账号?去注册
                  </a>
                  <a href="{{route('oauth',['type'=>'wechat'])}}" class="inline-block pl-1">
                    <svg t="1585367706568" class="icon" viewBox="0 0 1024 1024" version="1.1"
                         xmlns="http://www.w3.org/2000/svg" p-id="1112" width="32" height="32">
                      <path
                        d="M347.729118 353.0242c-16.487119 0-29.776737 13.389539-29.776737 29.776737S331.241998 412.677596 347.729118 412.677596s29.776737-13.389539 29.776737-29.776737-13.289617-29.876659-29.776737-29.876659zM577.749415 511.800156c-13.689305 0-24.880562 11.091335-24.880563 24.880562 0 13.689305 11.091335 24.880562 24.880563 24.880562 13.689305 0 24.880562-11.191257 24.880562-24.880562s-11.191257-24.880562-24.880562-24.880562zM500.909446 412.677596c16.487119 0 29.776737-13.389539 29.776737-29.776737s-13.389539-29.776737-29.776737-29.776737c-16.487119 0-29.776737 13.389539-29.776737 29.776737s13.289617 29.776737 29.776737 29.776737zM698.455113 511.600312c-13.689305 0-24.880562 11.091335-24.880562 24.880562 0 13.689305 11.091335 24.880562 24.880562 24.880562 13.689305 0 24.880562-11.091335 24.880562-24.880562-0.099922-13.689305-11.191257-24.880562-24.880562-24.880562z"
                        fill="#00C800" p-id="1113"></path>
                      <path
                        d="M511.601093 0.799375C229.12178 0.799375 0.000781 229.820453 0.000781 512.399688s229.021077 511.600312 511.600312 511.600312 511.600312-229.021077 511.600312-511.600312S794.180328 0.799375 511.601093 0.799375z m-90.229508 634.504294c-27.37861 0-49.361436-5.595628-76.839969-10.991413l-76.640125 38.469945 21.882904-65.948477c-54.957065-38.370023-87.73146-87.831382-87.73146-148.084309 0-104.318501 98.722873-186.554254 219.32865-186.554255 107.815769 0 202.34192 65.648712 221.327088 153.979703-6.994536-0.799375-13.989071-1.298985-21.083529-1.298985-104.118657 0-186.454333 77.739266-186.454332 173.564403 0 15.98751 2.498048 31.275566 6.794692 45.964091-6.794692 0.599532-13.689305 0.899297-20.583919 0.899297z m323.547228 76.839969l16.48712 54.757221-60.153006-32.874317c-21.882904 5.495706-43.965652 10.991413-65.848555 10.991413-104.318501 0-186.554254-71.344262-186.554255-159.175644 0-87.631538 82.135831-159.175644 186.554255-159.175644 98.523029 0 186.254489 71.444184 186.254488 159.175644 0.099922 49.461358-32.774395 93.227166-76.740047 126.301327z"
                        fill="#00C800" p-id="1114"></path>
                    </svg>
                  </a>
                </p>
              </form>

            </div>
            {{--            <div--}}
            {{--              class="ch-input-wrap listbox remove"--}}
            {{--              id="zhlogin"--}}

            {{--            >--}}
            {{--              @include('shared._messages')--}}
            {{--              <form method="POST" action="{{ route('login') }}">--}}
            {{--                @csrf--}}

            {{--                <div class="form-item">--}}

            {{--                  <div class="hd"> <span id="logerror" class="wrong c-red"--}}
            {{--                                         style="color:red"--}}
            {{--                    >* <em></em--}}
            {{--                      ></span>用户名：--}}
            {{--                  </div>--}}
            {{--                  <div class="input-div">--}}
            {{--                    <input--}}
            {{--                      class="input"--}}
            {{--                      name="phone"--}}
            {{--                      id="name"--}}
            {{--                      type="text"--}}
            {{--                      placeholder="手机号"--}}
            {{--                      autocomplete="off"--}}
            {{--                      value="{{old('phone')}}"--}}
            {{--                    />--}}
            {{--                    <span class="invalid_feedback" role="alert">--}}
            {{--                  </span>--}}
            {{--                  </div>--}}

            {{--                </div>--}}
            {{--                <div class="form-item">--}}
            {{--                  <div class="hd"> <span id="logerror" class="wrong c-red"--}}
            {{--                                         style="color:red"--}}
            {{--                    >* <em></em--}}
            {{--                      ></span>密 码：--}}
            {{--                  </div>--}}
            {{--                  <div class="input-div">--}}
            {{--                    <input--}}
            {{--                      class="input @error('phone') is_invalid @enderror"--}}
            {{--                      name="password"--}}
            {{--                      id="password"--}}
            {{--                      type="password"--}}
            {{--                      placeholder="请输入密码"--}}
            {{--                      autocomplete="new-password"--}}
            {{--                      value="{{old('password')}}"--}}
            {{--                    />--}}
            {{--                    <span class="invalid_feedback" role="alert">--}}
            {{--                  </span>--}}
            {{--                  </div>--}}
            {{--                </div>--}}

            {{--                <div class="form-item">--}}
            {{--                  <div class="agreement">--}}
            {{--                    <input--}}
            {{--                      id="chkLoginType"--}}
            {{--                      type="checkbox"--}}
            {{--                      name="remember"--}}
            {{--                    />--}}
            {{--                    记住密码--}}
            {{--                  </div>--}}
            {{--                </div>--}}
            {{--                <div class="form-item">--}}
            {{--                  <input--}}
            {{--                    id="btnSubmit"--}}
            {{--                    type="button"--}}
            {{--                    class="btn-login"--}}
            {{--                    value="登 录"--}}
            {{--                  />--}}
            {{--                </div>--}}


            {{--              </form>--}}
            {{--              <div class="form-item">--}}
            {{--                还没有账号？<a--}}
            {{--                  href="{{route('register')}}"--}}
            {{--                >立即注册</a--}}
            {{--                >--}}
            {{--                <a href="{{route('oauth',['type'=>'wechat'])}}"--}}
            {{--                   style="padding-left: 20px;font-size: 2rem; cursor: pointer"><i--}}
            {{--                    class="fab fa-weixin"></i></a>--}}
            {{--              </div>--}}
            {{--              <div class="oauth" style="padding: 20px 0px;">--}}
            {{--                <p style="text-align: center">--}}
            {{--                  <i class="icon icon-qq"></i>--}}
            {{--                  <i class="icon icon-wx" style=""></i>--}}
            {{--                </p>--}}
            {{--              </div>--}}
            {{--            </div>--}}
            {{--            <div class="content listbox " style="display: none" id="wxlogin">--}}
            {{--              <div class="tit">--}}
            {{--                <p>微信扫一扫 享免费检测</p>--}}
            {{--              </div>--}}
            {{--              <div class="codeimg">--}}
            {{--                <img id="" src="" alt="更新二维码"/>--}}
            {{--              </div>--}}

            {{--              <div class="box-word">无需注册，一键登录</div>--}}
            {{--            </div>--}}
            {{--          </div>--}}
            @else
              <div class="flex flex-col align-middle">
                <div class=" text-center  px-4 py-2 m-2">欢迎您</div>
                <div class=" text-center  px-4 py-2 m-2"><img
                    src='{{Auth::user()->avatar??'https://css.lianwen.com/images/head.jpg'}}' class='w-50 h-50 m-auto'>
                </div>
                <div
                  class=" text-center  px-4 py-2 m-2">{{auth()->user()->phone??auth()->user()->nickname}}</div>
                <div class=" text-center  px-4 py-2 m-2">
                  <a href="javascript:;"
                     class="rounded-sm logout text-decoration-none w-100 inline-block py-1 bg-teal-500 hover:bg-teal-600 md:text-lg xl:text-base text-white font-semibold  shadow-md">退出登录</a>
                </div>
              </div>
              {{--          <div class="box-main">--}}
              {{--            <div class="content listbox">--}}
              {{--              <p class='logintitle'>欢迎你</p>--}}
              {{--              <p class='loginname'>{{Auth::user()->nick_name}}</p>--}}
              {{--              <img src='{{Auth::user()->avatar??'https://css.lianwen.com/images/head.jpg'}}' class='loginimg'>--}}
              {{--              <a href='javascript:;' class='exit logout'>退出</a>--}}
              {{--            </div>--}}
              {{--          </div>--}}
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
          @auth
          swal({
            // content 参数可以是一个 DOM 元素，这里我们用 jQuery 动态生成一个 img 标签，并通过 [0] 的方式获取到 DOM 元素
            text: '关注公众号,获取更多资讯!',
            content: $("<img class='inline-block' src=\"{{ asset('asset/images/691584772794_.pic.jpg') }}\" />")[0],
            // buttons 参数可以设置按钮显示的文案
          })
          @endauth
          $('#btnSubmit').click(() => {
            axios.post('{{ route('login') }}', {
              phone: $('#name').val(),
              password: $('#password').val()
            }).then(res => {
              location.reload();
            }).catch(err => {
              if (err.response.status == 422) {
                $.each(err.response.data.errors, (field, errors) => {
                  if (field == 'phone') {
                    $('#name').addClass('is_invalid')
                    $('#name+p').html('<strong>' + errors[0] + '</strong>');
                  } else {
                    $('#password').addClass('is_invalid')
                    $('#password+p').html('<strong>' + errors[0] + '</strong>');
                  }
                })
              }
            });
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
