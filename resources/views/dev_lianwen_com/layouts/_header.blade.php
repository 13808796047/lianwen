<nav class="flex items-center justify-between flex-wrap bg-white-100 shadow-2xl">
  <div class="flex items-center flex-shrink-0 text-white mr-6 bg-blue-600 p-2">
    <a href="/"><img src="https://css.lianwen.com/logo/2019/weipudx.png" alt=""></a>
  </div>
  <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    <ul>
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
