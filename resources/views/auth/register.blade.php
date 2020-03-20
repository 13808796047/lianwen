@extends('layouts.app')
@section('styles')

  <link href="{{asset('asset/css/bootstrap.css')}}" rel="stylesheet"/>
  <link href="{{asset('asset/css/theme.css')}}" rel="stylesheet"/>
  <link href="{{asset('asset/css/alertify.css')}}" rel="stylesheet"/>
  <link href="{{asset('asset/css/index.css')}}" rel="stylesheet"/>
@stop

@section('content')
  <div id="wrap">


    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="row-fluid">
            <div class="widget container-narrow">
              <div class="widget-header">
                <i class="icon-edit"></i>
                <h5>注册新账号</h5>
              </div>
              <div class="widget-body clearfix" style="padding:25px;">
                <!--?php echo form_open($this->uri->uri_string()); ?-->
                <form action="{{route('register')}}" method="post" accept-charset="utf-8">
                @csrf
                <!--	<div style="padding:10px 0">
                          <a style="" href="#" class="btn btn-large btn-block btn-primary"><i class="icon-facebook-sign"></i> 使用QQ关联注册</a>
                      </div>
                       <br>
                      <legend style="font-size: 16px; color:#555;" class=""><i class="icon-envelope"></i> 您也可以使用邮箱注册</legend> -->
                  <div class="control-group ">
                    <label for="phone">手机号码:</label>
                    <div class="controls"><input type="text" name="phone" value="{{old('phone')}}" id="phone"
                                                 placeholder="请输入手机号码"
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
                  <div class="control-group ">
                    <label for="password">密码:</label>
                    <div class="controls"><input type="password" name="password" value="{{old('password')}}"
                                                 id="password"
                                                 class="btn-block" placeholder="请输入密码">
                      @error('password')
                      <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                      @enderror
                    </div>
                  </div>
                  <div class="control-group ">
                    <label for="password-confirm">重复密码:</label>
                    <div class="controls"><input type="password" name="password_confirmation" value=""
                                                 id="password-confirm"
                                                 class="btn-block" placeholder="请输入确认密码">
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
                  <div class="control-group ">
                    <label for="phone">验证码:</label>
                    <div class="controls"><input type="text" name="code" value="" id="code" placeholder="请输入验证码">
                      <input type="button" value="获取验证码"
                             style="margin-bottom: 10px;font-size: 14px;line-height: 20px;height:30px" id="yzm"
                      >
                    </div>
                  </div>


                  <button type="button" class="btn btn-large btn-block" id="submitBtn">立即注册</button>
                </form>
              </div>
            </div>
            <div style="text-align:center">
              <p>已有账号? <a href="{{route('pages.index')}}">登录</a></p>
            </div>
          </div><!--/row-fluid-->
        </div><!--/span10-->
      </div><!--/row-fluid-->
    </div><!--/.fluid-container-->
  </div>
@endsection
@section('scripts')
  <script !src="">
    $(() => {
      var wait = 60;

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
        var reg = /^1[34578]\d{9}$/;
        if (!reg.test(phone)) {
          index.removeAttribute("disabled");
          $("input[name='phone']").focus();
          $('#phone+span').html('<strong>请输入正确的手机号码</strong>');
          return;
        }
        axios.post('/api/v1/verificationCodes', {
          phone: phone,
        }).then(res => {
          alert('发送成功，请注意查收!')
          time(index);
          localStorage.setItem('code', "verificationCode_KEezsSSzqKi1oDD");
        }).catch(err => {
          index.removeAttribute("disabled");
          if (err.response.status == 422) {
            $.each(err.response.data.errors, (field, errors) => {
              if (field == 'phone') {
                $('#phone+span').html('<strong>' + errors[0] + '</strong>');
              }
            })
          }
        })
      }

      $('#yzm').click(function () {
        getcode(this)
      })

      //
      $('#submitBtn').click(() => {
        let code = localStorage.getItem('code');
        console.log(code)
      })
    })
  </script>
@stop
