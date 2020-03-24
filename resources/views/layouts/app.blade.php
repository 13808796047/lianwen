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
  @yield('styles')
</head>

<body>
<div id="app" class="{{ route_class() }}-page">

  @include('layouts._header')


  @include('shared._messages')

  @yield('content')


  @include('layouts._footer')
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
      buttons: true,
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
