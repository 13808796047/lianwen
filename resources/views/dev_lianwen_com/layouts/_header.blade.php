<nav class="flex items-center justify-between flex-wrap bg-white-100 shadow-2xl">
  <div class="flex items-center flex-shrink-0 text-white mr-6 bg-blue-600 p-2">
    <a href="/"><img src="https://css.lianwen.com/logo/2019/weipudx.png" alt=""></a>
  </div>
  <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto">
    <div class="text-sm lg:flex-grow" id="categories">

      <a href="/"
         class="block  lg:inline-block lg:mt-0 text-black-500 hover:text-blue-600 mr-4 text-decoration-none">
        首页
      </a>

      <li class="nav-item dropdown" style="display: inline;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: inline;">
          初稿查重
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/categories/1">联文检测</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/categories/5">PaperPass</a>
        </div>
      </li>
      <li class="nav-item dropdown" style="display: inline;">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: inline;">
          定稿查重
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/categories/4">万方检测</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/categories/2">维普查重</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/categories/3">知网查重</a>
        </div>
      </li>

      <a href="{{route('orders.index')}}"
         class="block  lg:inline-block lg:mt-0 text-black-500 hover:text-blue-600 mr-4 text-decoration-none">
        查看报告
      </a>
    </div>
    @auth
      <div class="flex justify-content-around w-25 align-items-center">
        <span>{{auth()->user()->phone??auth()->user()->nickname}}</span>
        <img
          src="{{Auth::user()->avatar??'https://css.lianwen.com/images/head.jpg'}}"
          class=" w-10 h-10"/>

        <a href="javascript:;"
           class="logout inline-block text-sm px-4 py-1 bg-teal-500 border rounded text-white border-white hover:border-transparent hover:text-black-500 hover:bg-red
          lg:mt-0">登出</a>
      </div>
    @endauth
  </div>
</nav>
<script>
$(function(){

})
  console.log({!! json_encode($categories) !!});
</script>
<!----- start-header---->
