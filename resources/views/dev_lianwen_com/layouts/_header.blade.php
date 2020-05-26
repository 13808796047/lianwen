
<link href="{{asset('asset/css/toast-min.css')}}" rel="stylesheet" />
<nav class="flex items-center justify-between flex-wrap bg-white-100" style="background:#fff;box-shadow: 0px 0px 3px #c1bebd;margin-bottom: 6px;font-size:0.965rem;" id="headernav">
  <div class="flex items-center flex-shrink-0 text-white mr-6 bg-blue-600" style="padding:0.5rem 1.5rem">
    <a href="/"><img src="https://css.lianwen.com/images/logo.png" alt=""></a>
  </div>
  <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto" style="margin-left:30px;">
    <div class="text-sm lg:flex-grow" id="categories">

      <a href="/"
         class="block  lg:inline-block lg:mt-0 text-black-500 hover:text-blue-600 mr-4 text-decoration-none istoaster">
        首页
      </a>

      <li class="nav-item dropdown" style="display: inline;">
        <span class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: inline;">
          初稿查重
        </span>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item istoaster" href="/categories/1">联文检测</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item istoaster" href="/categories/5">PaperPass</a>
        </div>
      </li>
      <li class="nav-item dropdown" style="display: inline;">
        <span class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: inline;">
          定稿查重
        </span>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item istoaster" href="/categories/4">万方检测</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item istoaster" href="/categories/2">维普查重</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item istoaster" href="/categories/3">知网查重</a>
        </div>
      </li>

      <a href="{{route('orders.index')}}"
         class="block  lg:inline-block lg:mt-0 text-black-500 hover:text-blue-600 mr-4 text-decoration-none istoaster" style="margin-left:15px;">
        查看报告
      </a>
      <a href="/ai_rewrite"
         class="block  lg:inline-block lg:mt-0 text-black-500 hover:text-blue-600 mr-4 text-decoration-none istoaster" style="margin-left:15px;">
        自动降重
      </a>
      <a href="javascript:void(0)" style="margin-left:15px;"
         class="block  lg:inline-block lg:mt-0 text-black-500 hover:text-blue-600 mr-4 text-decoration-none" onclick="window.open('http://p.qiao.baidu.com/cps/chat?siteId=12623578&userId=26512539&cp=lianwen&cr=lianwen&cw=PC',height='680',width='900')">
        在线客服
      </a>
    </div>
    @auth
      <div class="flex justify-content-around w-25 align-items-center">
        <img
          src="{{Auth::user()->avatar??'https://css.lianwen.com/images/head.jpg'}}"
          class=" w-10 h-10"/>
        <span>{{auth()->user()->phone??auth()->user()->nickname}}</span>


        <a href="javascript:;"
           class="logout inline-block text-sm px-4 py-1 bg-teal-500 border rounded text-white border-white hover:border-transparent hover:text-black-500 hover:bg-red
          lg:mt-0">登出</a>
      </div>
    @else
    <div class="flex justify-content-around w-25 align-items-center">

        <a href="https://2019.lianwen.com" class="inline-block text-sm px-4 py-1 bg-teal-500 border rounded text-white border-white hover:border-transparent hover:text-black-500 hover:bg-red
          lg:mt-0" target="_blank">旧版入口</a>
    </div>
    @endauth

  </div>
</nav>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
   toastr.options = {

     "closeButton": true, //是否显示关闭按钮

     "debug": true, //是否使用debug模式

     "showDuration": "1000",//显示的动画时间

     "hideDuration": "1000",//消失的动画时间

     "positionClass": "toast-center-center",//弹出窗的位置

     "timeOut": "1000", //展现时间

     "extendedTimeOut": "1000",//加长展示时间

     "showEasing": "swing",//显示时的动画缓冲方式

     "hideEasing": "linear",//消失时的动画缓冲方式

     "showMethod": "fadeIn",//显示时的动画方式

     "hideMethod": "fadeOut" //消失时的动画方式
   };

  @unless(Auth::user())
    let atag = document.querySelector('.istoaster')
    for(let i in atag){
      atag[i].onclick = function(event){
          event.preventDefault()
          toastr.error('当前未登录账号，请登录后再操作');
      }
    }
  @endunless
</script>
<!----- start-header---->
