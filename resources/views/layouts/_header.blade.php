{{--<div class="head" style="margin-bottom:5px;">--}}
{{--  <div class="nav clearfix">--}}
{{--    <div class="logo fl" style="padding-top:10px;padding-bottom:10px;">--}}
{{--      <a href="/"--}}
{{--      ><img--}}
{{--          src="https://css.lianwen.com/logo/2019/weipudx.png"--}}
{{--          height="55"--}}
{{--        /></a>--}}
{{--    </div>--}}
{{--    <ul class="navlist fl">--}}
{{--      @foreach($categories as $category)--}}

{{--        <li><a href="{{route('categories.show',['classid'=>$category->classid])}}">{{$category->classname}}</a></li>--}}
{{--      @endforeach--}}
{{--      <li id="report"><a href="{{route('orders.index')}}">查看报告</a></li>--}}
{{--    </ul>--}}

{{--    @auth--}}
{{--      <div class="more fr">--}}
{{--        <img--}}
{{--          src="{{Auth::user()->avatar??'https://css.lianwen.com/images/head.jpg'}}"--}}
{{--          class="imguser"--}}
{{--        /><a href="javascript:;" class="reg logout">登出</a>&nbsp;<a--}}
{{--          class="reg"--}}
{{--        >个人中心</a--}}
{{--        >--}}
{{--      </div>--}}
{{--      {{ Auth::user()->nick_name }}--}}
{{--    @endauth--}}
{{--  </div>--}}
{{--</div>--}}
<nav class="flex items-center justify-between flex-wrap bg-white-100">
  <div class="flex items-center flex-shrink-0 text-white mr-6 bg-blue-600 p-2">
    <img src="https://css.lianwen.com/logo/2019/weipudx.png" alt="">
  </div>
  <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
    <div class="text-sm lg:flex-grow">
      @foreach($categories as $category)
        <a href="{{route('categories.show',['classid'=>$category->classid])}}"
           class="block  lg:inline-block lg:mt-0 text-black-500 hover:text-blue-600 mr-4 text-decoration-none">
          {{$category->classname}}
        </a>
      @endforeach
    </div>
    @auth
      <div>
        <img
          src="{{Auth::user()->avatar??'https://css.lianwen.com/images/head.jpg'}}"
          class="imguser"/>
        <a href="javascript:;"
           class="logout inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-black-500 hover:bg-red
          lg:mt-0">登出</a>
      </div>
    @endauth
  </div>
</nav>
