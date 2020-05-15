<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>
  .foraml-box.register {
    background: url(https://s0.5118img.com/assist/images/formal/invite/bk_4.jpg?v=d5596a1a6d) top no-repeat, url(https://s0.5118img.com/assist/images/formal/invite/bk_4.jpg?v=d5596a1a6d) center 380px no-repeat;
    background-color: #f54c15;
  }

  .bk.register {
    background: url(https://s0.5118img.com/assist/images/formal/invite/bk_4.jpg?v=d5596a1a6d) no-repeat #f44b12;
    background-color: #f54c15;
    background-size: 100% auto;
  }

  * {
    padding: 0;
    margin: 0;
  }

  .foraml-box {
    padding: 300px 0 1px;
  }

  .foraml-box.register .envelope {

    width: 901px;
    height: 480px;
    margin: 0 auto;
    text-align: center;
  }

  .foraml-box .t {
    font-size: 36px;
    color: #fbf0a6;
    text-align: center;
    margin: 80px 0 35px;
  }

  .foraml-box .card {
    margin: 0 auto;
    width: 880px;
    font-family: SourceHanSansCN-Normal;
    background-color: #fff3e3;
    border-radius: 16px;
    text-align: center;
    font-size: 16px;
    line-height: 40px;
    color: #7b3015;
  }

  #app {
    width: 100%;
    height: 100%;
  }

  .bk.register .envelope .line {
    height: 1px;
    border-bottom: 1px solid #ccc;
    width: 60vw;
    margin: 5vw auto;
  }

  .bk .card {
    margin: 0 auto;
    width: 80%;
    font-family: SourceHanSansCN-Normal;
    background-color: #fff3e3;
    border-radius: 3vw;
    text-align: center;
    font-size: 5vw;

    color: #7b3015;
  }
</style>

<body>
  <section class="foraml-box register" id="web">
    <div style="margin:0 auto;">
      <p style="font-size:123px;text-align:center;font-weight:bold;color:#fbf0a6">立即注册送查重次数</p>
    </div>
    <div class="envelope" style="padding:10px 100px">
      <div style="display:flex;justify-content: center;align-items: center;">
        <p style="background:#4876FF;font-size:50px;color:#fff;padding: 10px 40px;margin-right:90px;">PC一键注册</p>
        <div style="text-align:center;">

          <img
            src="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=gQGR8DwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAyQUxyNFp4RVFjeTIxUlhBQWh1YzIAAgR717xeAwQAjScA"
            style="width:300px;height:300px;">
          <p style="line-height: 50px;font-size: 16px;color: #7b3015;">微信扫码注册</p>
        </div>
      </div>
    </div>

    <p class="t">简单三步<span></span>即送代金券</p>
    <div class="card" style="padding: 60px 0 50px;">
      <p>1、分享给好友</p>
      <p>2、好友成功注册</p>
      <p>3、双方各获得各5次自动降重次数</p>
    </div>
    <p class="t">推荐注册<span></span>活动规则</p>
    <div class="card" style="text-align:left;padding: 40px 40px;">
      <p>1、每推荐1名好友成功注册（绑定微信或手机号码），推荐人/注册人各获得10元无门槛代金券；代金券获得数量无上限</p>
      <p>2、代金券有效期为1个月；</p>
      <p>3、代金券不能提现，仅用于购买5118服务时消费抵扣，无门槛代金券最多可叠加10张抵扣；</p>
      <p>4、注册过程中使用了多人的推荐链接，以最后使用的推荐链接为准；</p>
      <p>5、对不符合活动规则的问题数据，5118有权撤销推荐和对应的代金券。</p>
      <p style="text-align:right;margin-top:40px;">活动最终解释权归5118官方</p>
    </div>
    <br>
    <br>
  </section>
  <div id="app" style="display: none;">
    <section>
      <div class="bk register">
        <div class="envelope">
          <div style="display:flex;padding:30vw 10vw 0;justify-content: center;color:#fbf0a6">
            <p style="font-size:6.7vw;font-weight:bold;">立即注册，送查重次数</p>
          </div>
          <div class="line"></div>
          <div style="text-align:center">
            <img
              src=""
              style="width:35vw;height:35vw;"
              id="qrimg">
            <p>微信扫码分享</p>
            <p style="line-height: 3vw;font-size: 2.8vw;">(可长按二维码自动识别)</p>
          </div>
        </div>
        <div>
          <p style="color: #fbf0a6;text-align:center;margin:7vw 0;font-size:6vw;">—— 简单三步送查重次数 ——</p>
        </div>
        <div class="card" style="padding: 5vw 8vw;text-align:left;font-weight:100">
          <p>1、分享给好友</p>
          <p>2、好友成功注册</p>
          <p>3、双方各获得各5次自动降重次数</p>
        </div>

        <div>
          <p style="color: #fbf0a6;text-align:center;margin:7vw 0;font-size:6vw;">—— 推荐注册活动规则 ——</p>
        </div>
        <div class="card" style="padding: 5vw 8vw;text-align:left;font-weight:100">
          <p>1、每推荐1名好友成功注册（微信登录或绑定手机号），推荐人和注册人各获得5次自动降重次数，获得的次数可叠加，无上限；</p>
          <p>2、所获得降重次数不可提现，仅用于使用自动降重服务时抵扣；</p>
          <p>3、严禁使用非法手段获取，对于问题账号本站有权撤销相应数据或封禁账号。</p>
        </div>

        <p style="color: #fbf0a6;text-align:center;padding:5vw 0">活动最终解释权归5118官方</p>
      </div>
    </section>

  </div>
</body>
<script type="text/javascript" src="{{ asset('asset/js/qrcode.min.js') }}"></script>
<script>

  !function () {
    var devices = ["iPhone", "Android", "Windows Phone"]
    var ua = window.navigator.userAgent
    for (var i = 0; i < devices.length; i++) {
      if (ua.indexOf(devices[i]) != -1) {
        console.log(1)
        document.getElementById('app').style.display = "block";
        document.getElementById('web').style.display = "none";
        return;
      } else {
        console.log(2)
        document.getElementById('app').style.display = "none";
        document.getElementById('web').style.display = "block";

      }
    }
  }()
  // 二维码
  axios.get('{{ route('official_account.index') }}').then(res => {
        // swal({
        //   // content 参数可以是一个 DOM 元素，这里我们用 jQuery 动态生成一个 img 标签，并通过 [0] 的方式获取到 DOM 元素
        //   content: $('<img src="' + res.data.url + '" style="display: block;margin: 0 auto;"/>')[0],
        // })
       document.getElementById("qrimg").src = res.data.url
  })
</script>

</html>
