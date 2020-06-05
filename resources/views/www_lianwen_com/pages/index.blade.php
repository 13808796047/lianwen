@extends('domained::layouts.app')
@section('title', '首页')
@section('styles')
  <link href="{{asset('asset/css/index.css')}}" rel="stylesheet"/>
  <style>
    .nav-link.active {
      border-radius: 0;
      border-bottom: #0d6aad 2px solid !important;
      background: #fff !important;
      color: #000 !important;
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
          <ul class="nav nav-pills mt-4 d-flex justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item mr-4">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                 aria-controls="pills-home" aria-selected="true" style="font-size:15px;">账号登录</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                 aria-controls="pills-profile" aria-selected="false" style="font-size:15px;">手机登录</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <div class="w-full">
                <form class="bg-white rounded px-4 pt-6">

                  <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                      用户名:
                    </label>
                    <input
                      class="appearance-none border rounded w-full py-2 px-3 mb-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      name="phone"
                      id="phone" type="text" placeholder="请输入手机号码" value="{{ old('phone') }}" style="font-size:14px;">


                  </div>
                  <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                      密码:
                    </label>
                    <input
                      class="appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                      name="password"
                      id="password" type="password" placeholder="请输入密码" value="{{ old('password') }}" style="font-size:14px;">

                  </div>
                  <div class="flex items-center justify-between my-2">
                    <button
                      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 w-full px-4 rounded focus:outline-none focus:shadow-outline"
                      type="button" id="accountLogin" style="font-size:15px;">
                      登录
                    </button>
                  </div>

                </form>

              </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
              <div class="w-full">
                <form class="bg-white rounded px-4 pt-6">
                  <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                      手机号码:
                    </label>
                    <input
                      class="appearance-none border rounded w-full py-2 px-2 mb-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      id="mobile" type="text" placeholder="请输入手机号码">
                    <p class="text-red-500 text-xs italic "></p>
                  </div>
                  <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                      验证码:
                    </label>
                    <div class="d-flex justify-content-between">
                      <input
                        class="appearance-none border border-red-500 rounded   py-2 px-2  w-full mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="verification_code" type="text" placeholder="请输入短信验证码"/>
                      <input
                        class="bg-blue-500 hover:bg-blue-700 px-2 py-1  text-white font-bold rounded"
                        type="button" id="verificationCode" value="发送验证码">

                    </div>
                    <p class="text-red-500 text-xs italic "></p>
                  </div>
                  <div class="flex items-center justify-between my-4">
                    <button
                      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 w-full px-4 rounded focus:outline-none focus:shadow-outline"
                      type="button" id="phoneLogin">
                      登录
                    </button>
                  </div>

                </form>

              </div>
            </div>
          </div>
          <p class="text-gray-500 text-xs px-8 d-flex justify-content-center">
            <a href="{{route('oauth',['type'=>'wechat'])}}" class="block mr-4">
              <svg t="1585367706568" class="icon" viewBox="0 0 1024 1024" version="1.1"
                   xmlns="http://www.w3.org/2000/svg" p-id="1112" width="24" height="24">
                <path
                  d="M347.729118 353.0242c-16.487119 0-29.776737 13.389539-29.776737 29.776737S331.241998 412.677596 347.729118 412.677596s29.776737-13.389539 29.776737-29.776737-13.289617-29.876659-29.776737-29.876659zM577.749415 511.800156c-13.689305 0-24.880562 11.091335-24.880563 24.880562 0 13.689305 11.091335 24.880562 24.880563 24.880562 13.689305 0 24.880562-11.191257 24.880562-24.880562s-11.191257-24.880562-24.880562-24.880562zM500.909446 412.677596c16.487119 0 29.776737-13.389539 29.776737-29.776737s-13.389539-29.776737-29.776737-29.776737c-16.487119 0-29.776737 13.389539-29.776737 29.776737s13.289617 29.776737 29.776737 29.776737zM698.455113 511.600312c-13.689305 0-24.880562 11.091335-24.880562 24.880562 0 13.689305 11.091335 24.880562 24.880562 24.880562 13.689305 0 24.880562-11.091335 24.880562-24.880562-0.099922-13.689305-11.191257-24.880562-24.880562-24.880562z"
                  fill="#00C800" p-id="1113"></path>
                <path
                  d="M511.601093 0.799375C229.12178 0.799375 0.000781 229.820453 0.000781 512.399688s229.021077 511.600312 511.600312 511.600312 511.600312-229.021077 511.600312-511.600312S794.180328 0.799375 511.601093 0.799375z m-90.229508 634.504294c-27.37861 0-49.361436-5.595628-76.839969-10.991413l-76.640125 38.469945 21.882904-65.948477c-54.957065-38.370023-87.73146-87.831382-87.73146-148.084309 0-104.318501 98.722873-186.554254 219.32865-186.554255 107.815769 0 202.34192 65.648712 221.327088 153.979703-6.994536-0.799375-13.989071-1.298985-21.083529-1.298985-104.118657 0-186.454333 77.739266-186.454332 173.564403 0 15.98751 2.498048 31.275566 6.794692 45.964091-6.794692 0.599532-13.689305 0.899297-20.583919 0.899297z m323.547228 76.839969l16.48712 54.757221-60.153006-32.874317c-21.882904 5.495706-43.965652 10.991413-65.848555 10.991413-104.318501 0-186.554254-71.344262-186.554255-159.175644 0-87.631538 82.135831-159.175644 186.554255-159.175644 98.523029 0 186.254489 71.444184 186.254488 159.175644 0.099922 49.461358-32.774395 93.227166-76.740047 126.301327z"
                  fill="#00C800" p-id="1114"></path>
              </svg>
            </a>
            <a class="block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
               href="{{route('register')}}">
              还没有账号?去注册
            </a>
          </p>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    $(function () {
      {{--      @auth--}}
      {{--      swal({--}}
      {{--        // content 参数可以是一个 DOM 元素，这里我们用 jQuery 动态生成一个 img 标签，并通过 [0] 的方式获取到 DOM 元素--}}
      {{--        text: '关注公众号,获取更多资讯!',--}}
      {{--        content: $("<img class='inline-block' src=\"{{ asset('asset/images/691584772794_.pic.jpg') }}\" />")[0],--}}
      {{--        // buttons 参数可以设置按钮显示的文案--}}
      {{--      })--}}
      {{--        @endauth--}}
      //账号登录
      $('#accountLogin').click(function () {
        axios.post('{{route('login') }}', {
          phone: $("input[name='phone']").val(),
          password: $("input[name='password']").val(),
          type: 'account'
        }).then(res => {
          if (res.status == 200) {
            swal("提示", res.data.message, "success");
            location.reload();
          } else {
            swal("提示", res.data.message, "error");
          }
        }).catch(err => {
          if (err.response.status == 422) {
            $.each(err.response.data.errors, (field, errors) => {
              swal("提示", errors[0], "error");
            })
          }
          if (err.response.status == 401) {
            $.each(err.response.data, (field, errors) => {
              swal("提示", errors, "error");
            })
          }
        })
      })
      var wait = 60;
      var verification_key = '';

      function time(o) {
        if (wait == 0) {
          o.removeAttribute("disabled");
          o.value = "点击获取验证码";
          wait = 60;
        } else {
          o.setAttribute("disabled", true);
          o.value = "重新发送(" + wait + ")";
          wait--;
          setTimeout(function () {
              time(o)
            },
            1000)
        }
      }

      function getcode(index) {
        index.setAttribute('disabled', true);
        var phone = $("#mobile").val();
        var reg = /^1[34578]\d{9}$/;
        if (!reg.test(phone)) {
          index.removeAttribute("disabled");
          $("input[name='phone']").focus();
          swal('提示信息', "请输入正确的手机号码!!!", "error");
          return;
        }
        axios.post('/api/v1/verificationCodes', {
          phone: phone,
        }).then(res => {
          swal('验证码已发送成功!,请注意查收!')
          time(index);
          verification_key = res.data.key;
        }).catch(err => {
          index.removeAttribute("disabled");
          if (err.response.status == 401) {
            $.each(err.response.data.errors, (field, errors) => {
              swal("提示", errors[0], "error");
            })
          }
        })
      }

      $('#verificationCode').click(function () {
        getcode(this)
      })
      $('#phoneLogin').click(() => {
        axios.post('{{ route('login') }}', {
          phone: $('#mobile').val(),
          verification_code: $('#verification_code').val(),
          verification_key: verification_key,
          type: 'phone'
        }).then(res => {
          location.reload();
        }).catch(err => {
          if (err.response.status == 401) {
            swal("提示", '用户不存在！！！', "error");
          }
          if (err.response.status == 422) {
            $.each(err.response.data.errors, (field, errors) => {
              swal("提示", errors[0], "error");
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
      toastr.options = {

"closeButton": true, //是否显示关闭按钮

"debug": true, //是否使用debug模式

"showDuration": "1000",//显示的动画时间

"hideDuration": "1000",//消失的动画时间

"positionClass": "toast-cent-cent",//弹出窗的位置

"timeOut": "1000", //展现时间

"extendedTimeOut": "1000",//加长展示时间

"showEasing": "swing",//显示时的动画缓冲方式

"hideEasing": "linear",//消失时的动画缓冲方式

"showMethod": "fadeIn",//显示时的动画方式

"hideMethod": "fadeOut" //消失时的动画方式
};

@unless(Auth::user())
console.log(window.location.href)
if(window.location.href=='https://www.lianwen.com/'){
 $('#jbrk').css('display','block')
}else{
 $('#jbrk').css('display','none')
}
if(window.location.href=='https://www.lianwen.com/ai_rewrite'){
 $('#dlzcrk').css('display','block')
}else{
 $('#dlzcrk').css('display','none')
}
let atag = document.getElementsByClassName("istoaster");
console.log(atag,3131)
for(let i in atag){
 atag[i].onclick = function(event){
     event.preventDefault()
     toastr.error('当前未登录账号，请登录后再操作');
 }
}
@endunless
    });
  </script>
@stop
