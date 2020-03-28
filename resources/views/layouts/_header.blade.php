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
