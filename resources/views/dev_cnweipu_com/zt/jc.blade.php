<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>推荐活动</title>
  <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.css') }}">
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
    padding: 150px 0 1px;
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

  .cards {
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

  .modalcontainer {
    margin: 0 auto;
  }

  .modalcontainer-div {
    display: flex;
    width: 80%;
    align-items: center;
    margin: 0 auto;
    height: 50px;
  }

  .modalcontainer-p {
    width: 19%;
    text-align: right;
    margin-left: 30px;
    margin-bottom: 0;
  }

  .modalcontainer-input {
    width: 70%;
    margin-left: 10px;
  }
</style>

<body>
 <!-- 二维码弹窗 -->
 <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
    id="registerModel">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: none;padding-top: 0;padding-bottom: 0;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div>
          <div class="alert alert-danger" role="alert" id="message" style="display: none"></div>
          <p style="font-size:23px;font-weight:bold;text-align:center;">注册</p>

          <div class="modalcontainer">
            <div class="modalcontainer-div">
              <p class='modalcontainer-p'>手机号</p>
              <input type="text" name="phone" id="phone" class="modalcontainer-input">
            </div>
            <div class="modalcontainer-div">
              <p class='modalcontainer-p'>密码</p>
              <input type="text" id="password" class="modalcontainer-input">
            </div>
            <div class="modalcontainer-div">
              <p class='modalcontainer-p'>确认密码</p>
              <input type="text" id="password-confirm" class="modalcontainer-input">
            </div>
            <div class="modalcontainer-div">
              <p class='modalcontainer-p'>验证码</p>
              <input type="text" style="width: 130px;" id="code" >
              <!-- <span  id="yzm">发送验证码</span> -->
              <input type="button" id="yzm" value="获取验证码" style="font-size: 14px;line-height: 20px;height:30px;background:#7CCD7C;color:#fff;padding:0 20px;width:120px;
                outline: none;border: 0;">
            </div>
          </div>
          <div style="display: flex;justify-content: center;">
            <span style="text-align: center;background-color: #4876FF;color: #fff;padding: 7px 13px;margin: 15px 0;"
              id='submitBtn'>立即注册</span>
          </div>
        </div>

      </div>
    </div>
  </div>
  </div>
  <!-- 二维码弹窗结束 -->
  <div class="foraml-box register" id="web">
    <p style="font-size: 123px;text-align: center;font-weight: bold;color: #fbf0a6;">立即查重 送降重次数</p>
    <div style="padding: 20px;display: flex;justify-content: center;">
      <p style="text-align: center;background: #4876FF;font-size: 50px;color:#fff;padding: 10px 30px;letter-spacing:20px"
        id="tjregister">
        一键注册</p>
    </div>
    <div>
      <p class="t">简单三步送降重次数</p>
      <div class="cards">
        <p>1.分享给好友</p>
        <p>2.好友成功注册</p>
        <p>3.双方各获得5次自动降重次数</p>
      </div>
    </div>
    <div style="padding-bottom: 150px;">
      <p class="t">推荐注册活动规则</p>
      <div class="cards">
        <p>1、分享给好友</p>
        <p>2.好友成功注册</p>
        <p>双方各获得5次自动降重次数</p>
      </div>
    </div>
  </div>
  </div>
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
            <p id="tests"></p>
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
<script src="https://cdn.bootcdn.net/ajax/libs/axios/0.19.2/axios.js"></script>
<script type="text/javascript" src="{{ asset('asset/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('asset/js/bootstrap.js') }}"></script>
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
  var search = window.location.search
  var id = getSearchString('uid', search);
  function getSearchString(key, Url) {
    var str = Url;
    str = str.substring(1, str.length); // 获取URL中?之后的字符（去掉第一位的问号）
    // 以&分隔字符串，获得类似name=xiaoli这样的元素数组
    var arr = str.split("&");
    var obj = new Object();
    // 将每一个数组元素以=分隔并赋给obj对象
    for (var i = 0; i < arr.length; i++) {
        var tmp_arr = arr[i].split("=");
        obj[decodeURIComponent(tmp_arr[0])] = decodeURIComponent(tmp_arr[1]);
    }
    return obj[key];
  }
  console.log(id,312312)
  axios.get('/invit_official?uid='+id).then(res => {
       console.log(res,313131311331)
       document.getElementById("qrimg").src = res.data.url
       document.getElementById("tests").innerText=res.data.url
  })

  var wait = 60;
  var verification_key = '';

  function time(o) {
    console.log(o, 123)
    if (wait == 0) {
      o.removeAttribute("disabled");
      o.value = "点击获取验证码";
      wait = 60;
    } else {
      o.setAttribute("disabled", true);
      o.value = "重新发送(" + wait + ")";
      wait--;
      setTimeout(function () {
        time(o)
      },
        1000)
    }
  }
  $('#tjregister').click(function(){
    console.log(1112)
    $('#registerModel').modal('show')
  })

  $('#yzm').click(function () {
    getcode(this)
  })
  function getcode(index) {
    index.setAttribute("disabled", true);
    var phone = $("input[name='phone']").val();
    var reg = /^1[3456789]\d{9}$/;
    if (!reg.test(phone)) {
      index.removeAttribute("disabled");
      $("input[name='phone']").focus();
      $('#message').show();
      $('#message').html('<strong>请输入正确的手机号码</strong>');
      return;
    }
    axios.post('https://dev.lianwen.com/api/v1/verificationCodes', {
      phone: phone,
    }).then(res => {
      // swal('验证码已发送成功!,请注意查收!')
      time(index);
      verification_key = res.data.key;
    }).catch(err => {
      index.removeAttribute("disabled");
      if (err.response.status == 422) {
        $('#message').show();
        $.each(err.response.data.errors, (field, errors) => {
          $('#message').html('<strong>' + errors[0] + '</strong>');
        })
      }
    })
  }

  $('#submitBtn').click(() => {
    axios.post('{{route('register')}}', {
      'verification_key': verification_key,
      'phone': $('#phone').val(),
      'password': $('#password').val(),
      'password_confirmation': $('#password-confirm').val(),
      'verification_code': $('#code').val()
    }).then(res => {
      alert("注册成功")
    }).catch(err => {
      // if (err.response.status == 422) {
      $('#message').show();
      // $.each(err.response.data.errors, (field, errors) => {
      //   $('#message').append('<strong>' + errors + '</strong> </br>');
      // })
      // }
    })
  })


</script>

</html>
