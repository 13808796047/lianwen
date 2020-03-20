<div class="head" style="margin-bottom:5px;">
  <div class="nav clearfix">
    <div class="logo fl" style="padding-top:10px;padding-bottom:10px;">
      <a href="./redirect.php?url=/"
      ><img
          src="https://css.lianwen.com/logo/2019/weipudx.png"
          height="55"
        /></a>
    </div>
    <ul class="navlist fl">
      <li><a href="./check/index/14#0">论文查重</a></li>
      <li><a href="./check/index/14#1">维普检测</a></li>
      <li><a href="./check/index/14#2">知网查重</a></li>
      <li id="report"><a href="./report">查看报告</a></li>
    </ul>

    @auth
      <div class="more fr">
        <img
          src="{{Auth::user()->avatar??'https://css.lianwen.com/images/head.jpg'}}"
          class="imguser"
        /><a href="./logout" class="reg">登出</a>&nbsp;<a
          href="./user/profile"
          class="reg"
        >个人中心</a
        >
      </div>
      {{ Auth::user()->nick_name }}
    @endauth
  </div>
</div>
