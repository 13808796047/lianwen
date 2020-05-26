@extends('domained::layouts.app')
@section('styles')

  <link href="{{asset('asset/css/bootstrap.css')}}" rel="stylesheet"/>
  <link href="{{asset('asset/css/check.css')}}" rel="stylesheet"/>
  <link href="{{asset('asset/css/theme.css')}}" rel="stylesheet"/>
  <link href="{{asset('asset/css/alertify.css')}}" rel="stylesheet"/>
  <link href="{{asset('asset/css/index.css')}}" rel="stylesheet"/>
  @stop

@section('content')

<div class="main clearfix" style="flex:1;padding:0">
      <div class="lbox fl">
        <div class="alert alert-danger" role="alert" id="message" style="display: none">
        </div>
        <form action="{{route('register')}}" method="post" accept-charset="utf-8" style="padding: 3% 23% 5%;">
        @csrf
        <!--	<div style="padding:10px 0">
                          <a style="" href="#" class="btn btn-large btn-block btn-primary"><i class="icon-facebook-sign"></i> 使用QQ关联注册</a>
                      </div>
                       <br>
                      <legend style="font-size: 16px; color:#555;" class=""><i class="icon-envelope"></i> 您也可以使用邮箱注册</legend> -->
          <div style="text-align: center;font-size: 21px;font-weight: bold;margin-bottom: 13px;">注册账号</div>
          <div class="control-group" style="margin-bottom: 13px;font-size:13px;">
            <label for="phone">手机号码:</label>
            <div class="controls"><input type="text" name="phone" value="{{old('phone')}}" id="phone"
                                         placeholder="请输入手机号码"
                                         style="border: 1px solid #ccc;font-size: 17px;height: 39px;padding-left: 10px;"
                                         class="btn-block">
              @error('phone')
              <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
              <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong></strong>
                                    </span>
            </div>

          </div>
          <div class="control-group" style="margin-bottom: 13px;font-size:13px;">
            <label for="password">密码:</label>
            <div class="controls"><input type="password" name="password" value="{{old('password')}}"
                                         id="password"
                                         class="btn-block" placeholder="请输入密码"
                                         style="border: 1px solid #ccc;font-size: 17px;height: 39px;padding-left: 10px;">
              @error('password')
              <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
              @enderror
            </div>
          </div>
          <div class="control-group" style="margin-bottom: 13px;font-size:13px;">
            <label for="password-confirm">重复密码:</label>
            <div class="controls"><input type="password" name="password_confirmation" value=""
                                         id="password-confirm"
                                         class="btn-block" placeholder="请输入确认密码"
                                         style="border: 1px solid #ccc;font-size: 17px;height:39px;padding-left:10px;">
            </div>
          </div>

          {{--                  <div class="control-group " style="display: none">--}}
          {{--                    <label for="email">邮箱:</label>--}}
          {{--                    <div class="controls"><input type="text" name="email" value="" id="email" class="btn-block">--}}
          {{--                    </div>--}}
          {{--                  </div>--}}

          {{--                  <div class="control-group ">--}}
          {{--                    <label for="phone">手机:</label>--}}
          {{--                    <div class="controls"><input type="text" name="phone" value="" id="phone" class="btn-block">--}}
          {{--                    </div>--}}
          {{--                  </div>--}}
          {{--                  <div id="sjh" style="color:red;display: none">手机号已存在</div>--}}
          <div class="control-group" style="margin-bottom: 13px;font-size:13px;">
            <label for="phone">验证码:</label>
            <div class="controls"><input type="text" name="code" value="" id="code"
                                         placeholder="请输入验证码"
                                         style="border:1px solid #ccc;font-size:17px;height:39px;padding-left:10px;">
              <input type="button" value="获取验证码"
                     style="margin-bottom: 10px;font-size: 14px;line-height: 20px;height:30px;background:#7CCD7C;color:#fff;padding:0 20px;"
                     id="yzm"
              >
            </div>
          </div>


          <button type="button" class="btn btn-large btn-block" id="submitBtn" style="background:#26AEF2;color:#fff;font-size:13px;">
            提交注册
          </button>
        </form>
      </div>
      <div class="rbox fr">
	    	<div style="background:#fff;padding:20px;font-size:13px;">
		    <b>1、检测结果是否准确？</b>
        <p>如果你们学校也是用维普检测，那结果是一致的。同一个的系统、同样的比对库、同样的算法，所以只要在本系统提交的内容和学校的一致，那检测结果是一致的。</p>
        <b>2、检测需要多少时间？</b>
        <p>正常情况，维普检测需要10分钟左右，高峰期可能会延迟，但不会超过1个小时，如果长时间未出结果请联系客服微信：cx5078解决。</p>
        <b>3、论文上传之后安全吗？</b>
        <p>本系统有明确的条文规定并遵守严格的论文保密规定，对所有用户提交的送检文档仅做检测分析，绝不保留全文，承诺对用户送检的文档不做任何形式的收录和泄露。</p>
        <b>4、提交以后能不能退款？</b>
        <p>此系统一旦提交，系统开始检测后，即产生消费，无法退款！</p>
        <b>5、检测内容范围？</b>
        <p>系统不检测文章中的封面、致谢、学校(需要替换成"X")等个人信息，请在提交前自己删除，若提交后由系统自动删除时出现的任何问题责任自负！</p>
        <b>6、检测时作者需要填吗？</b>
        <p>在提交检测的文章中，引用了一些内以前自己所写的内容并且被小论文系统文献库收录，需要在此次检测中排除这些；则会有“去除本人已发表文献复制比”的结果。</p>
	    	</div>
      </div>
	</div>
</div>
    @endsection
@section('scripts')
@section('scripts')
      <script !src="">
        $(() => {

          $('#categories').css('font-size','14px')
          $('#categories a').css('color','black')
          $('#lwfoot').css('font-size','14px')

          var wait = 60;
          var verification_key = '';

          function time(o) {
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

          function getcode(index) {
            index.setAttribute("disabled", true);
            var phone = $("input[name='phone']").val();
            var reg = /^1[345678]\d{9}$/;
            if (!reg.test(phone)) {
              index.removeAttribute("disabled");
              $("input[name='phone']").focus();
              $('#message').show();
              $('#message').html('<strong>请输入正确的手机号码</strong>');
              return;
            }
            axios.post('/api/v1/verificationCodes', {
              phone: phone,
            }).then(res => {
              swal('验证码已发送成功!,请注意查收!')
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

          $('#yzm').click(function () {
            getcode(this)
          })

          //
          $('#submitBtn').click(() => {
            axios.post('{{route('register')}}', {
              'verification_key': verification_key,
              'phone': $('#phone').val(),
              'password': $('#password').val(),
              'password_confirmation': $('#password-confirm').val(),
              'verification_code': $('#code').val()
            }).then(res => {
              swal("注册成功!");
              location.href = '{{route('pages.index')}}'
            }).catch(err => {
              if (err.response.status == 422) {
                $('#message').show();
                $.each(err.response.data.errors, (field, errors) => {
                  $('#message').append('<strong>' + errors + '</strong> </br>');
                })
              }
            })
          })
        })
      </script>
@stop
