<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', '联文') - 论文查重</title>

  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <style>
    .newbody{
      height:100%;
      margin-bottom:0;
    }
    .newmain{
      display:flex;
      flex-direction:column;
      height:100%;
    }
  </style>
  @yield('styles')
  <script>
    //H5移动版自适应跳转js
    var mobileAgent = new Array("iphone", "ipod", "ipad", "android", "mini", "mobile", "mobi", "mqqbrowser", "blackberry",
      "webos", "incognito", "webmate", "bada", "nokia", "symbian", "wp7", "wp8", "lg", "ucweb", "skyfire");
    var browser = navigator.userAgent.toLowerCase();
    var _tag = "{$_GET['tag']}";
    if (_tag != 'web') {
      for (var i = 0; i < mobileAgent.length; i++) {
        if (browser.indexOf(mobileAgent[i]) != -1) {
          window.location.href = 'https://wap.lianwen.com/wanfang';
          break;
        }
      }
    }
  </script>
</head>

<body class="newbody">
<div id="app" class="{{ route_class() }}-page newmain">

  @include('domained::layouts._header')


  @include('domained::shared._messages')

  @yield('content')


  @include('domained::layouts._footer')
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
@yield('scripts')
<script !src="">

  //退出登录
  $('.logout').click(() => {
    swal({
      title: "您确认要退出登录吗?",
      icon: "warning",
      buttons: ['取消','确定'],
      dangerMode: true,
    })
      .then((willDelete) => {
        if (willDelete) {
          axios.post('{{route('logout')}}').then(res => {
            swal("注销成功!", {
              icon: "success",
            }).then(willDelete => {
              location.reload();
            });
          })
        }
      });
  });
</script>
</body>

</html>
