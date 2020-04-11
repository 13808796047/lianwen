{{--<nav class="flex items-center justify-between flex-wrap bg-white-100 shadow-2xl">--}}
{{--  <div class="flex items-center flex-shrink-0 text-white mr-6 bg-blue-600 p-2">--}}
{{--    <a href="/"><img src="https://css.lianwen.com/logo/2019/weipudx.png" alt=""></a>--}}
{{--  </div>--}}
{{--  <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto">--}}
{{--    <div class="text-sm lg:flex-grow">--}}
{{--      @foreach($categories as $category)--}}
{{--        <a href="{{route('categories.show',['classid'=>$category->classid])}}"--}}
{{--           class="block  lg:inline-block lg:mt-0 text-black-500 hover:text-blue-600 mr-4 text-decoration-none">--}}
{{--          {{$category->classname}}--}}
{{--        </a>--}}
{{--      @endforeach--}}
{{--      <a href="{{route('orders.index')}}"--}}
{{--         class="block  lg:inline-block lg:mt-0 text-black-500 hover:text-blue-600 mr-4 text-decoration-none">--}}
{{--        查看报告--}}
{{--      </a>--}}
{{--    </div>--}}
{{--    @auth--}}
{{--      <div class="flex justify-content-around w-25 align-items-center">--}}
{{--        <span>{{auth()->user()->phone??auth()->user()->nickname}}</span>--}}
{{--        <img--}}
{{--          src="{{Auth::user()->avatar??'https://css.lianwen.com/images/head.jpg'}}"--}}
{{--          class=" w-10 h-10"/>--}}

{{--        <a href="javascript:;"--}}
{{--           class="logout inline-block text-sm px-4 py-1 bg-teal-500 border rounded text-white border-white hover:border-transparent hover:text-black-500 hover:bg-red--}}
{{--          lg:mt-0">登出</a>--}}
{{--      </div>--}}
{{--    @endauth--}}
{{--  </div>--}}
{{--</nav>--}}
{{--<nav class="flex items-center justify-between flex-wrap bg-white-100" style="display: flex;flex-wrap: nowrap;">--}}
{{--  <div class="flex items-center" style="background-color:#0084DB;width: 20%;">--}}
{{--    <a href=" ">--}}
{{--      <img src="https://css.lianwen.com/logo/2019/weipudx.png" alt=""--}}
{{--           style="width: 100%;padding: 15px;height: 100%;"></a>--}}
{{--  </div>--}}
{{--  <div style="display:flex;flex: 1;align-items: center;box-sizing: border-box;flex-wrap: nowrap;">--}}
{{--    @foreach($categories as $category)--}}
{{--      <a href="{{route('categories.show',['classid'=>$category->classid])}}"--}}
{{--         class="block lg:inline-block lg:mt-0 text-black-500 hover:text-blue-600 mr-4 text-decoration-none"--}}
{{--         style="margin: 0 25px;">{{$category->classname}}</a>--}}
{{--    @endforeach--}}
{{--    <a href="{{route('orders.index')}}"--}}
{{--       class="block  lg:inline-block lg:mt-0 text-black-500 hover:text-blue-600 mr-4 text-decoration-none"--}}
{{--       style="margin: 0 25px;">--}}
{{--      查看报告--}}
{{--    </a>--}}
{{--  </div>--}}
{{--  @auth--}}
{{--    <div class="w-25 align-items-center" style="display: flex;flex-wrap: nowrap;">--}}
{{--      <span>{{auth()->user()->phone??auth()->user()->nickname}}</span>--}}
{{--      <img src="{{Auth::user()->avatar??'https://css.lianwen.com/images/head.jpg'}}" class=" w-10 h-10"/>--}}

{{--      <a href="javascript:;" class="logout inline-block text-sm px-4 py-1 bg-teal-500 border rounded text-white border-white hover:border-transparent hover:text-black-500 hover:bg-red--}}
{{--        lg:mt-0">登出</a>--}}
{{--    </div>--}}
{{--  @endauth--}}
{{--</nav>--}}
<div id="home" class="header">
  <div class="container">
    <div class="logo">
      <a href="/"><img src="http://www.zcnki.com/asset/images/logo/wanfang.png" title="logo"/></a>
    </div>
    <!----start-top-nav---->
    <nav class="top-nav float-left ml-16">
      <ul class="top-nav">
        <li class="active"><a href="/" class="scroll">首页<span> </span></a></li>

        <li class="page-scroll"><a href="{{route('categories.show',['classid'=>4])}}" id="login1"
                                   class="scroll">万方查重<span> </span></a></li>

        <li class="page-scroll"><a href="{{route('orders.index')}}" id="down" class="scroll">查看报告<span> </span></a></li>
        <li class="contatct-active" class="page-scroll"><a href="javascript:void(0)"
                                                           onclick="window.open('http://p.qiao.baidu.com/cps/chat?siteId=12623578&userId=26512539&cp=lianwen&cr=lianwen&cw=PC',height='680',width='900')"
                                                           class="scroll">在线咨询</a></li>
      </ul>
    </nav>
    @auth

      <div class="align-items-center float-right flex text-sm mt-3">
        {{--            <span>{{auth()->user()->phone??auth()->user()->nickname}}</span>--}}
        {{--            <img src="{{Auth::user()->avatar??'https://css.lianwen.com/images/head.jpg'}}" class=" w-10 h-10"/>--}}

        <a href="javascript:;" class="logout inline-block text-sm px-4 py-1 bg-teal-500 border rounded text-white border-white hover:border-transparent hover:text-black-500 hover:bg-red
                lg:mt-0">登出</a>
      </div>
    @endauth
    <div class="clearfix"></div>
  </div>
</div>
<!----- //End-header---->
