<div class="head" style="margin-bottom:5px;">
  <div class="nav clearfix">
    <div class="logo fl" style="padding-top:10px;padding-bottom:10px;">
      <a href="/"
      ><img
          src="https://css.lianwen.com/logo/2019/weipudx.png"
          height="55"
        /></a>
    </div>
    <ul class="navlist fl">
      @foreach($categories as $category)

        <li><a href="{{route('categories.show',['classid'=>$category->classid])}}">{{$category->classname}}</a></li>
      @endforeach
      <li id="report"><a href="./report">查看报告</a></li>
    </ul>

    @auth
      <div class="more fr">
        <img
          src="{{Auth::user()->avatar??'https://css.lianwen.com/images/head.jpg'}}"
          class="imguser"
        /><a href="javascript:;" class="reg logout">登出</a>&nbsp;<a
          class="reg"
        >个人中心</a
        >
      </div>
      {{ Auth::user()->nick_name }}
    @endauth
  </div>
</div>
