@extends('domained::layouts.app')
@section('title','智能查重')
@section('styles')
  <!-- <link href="https://css.lianwen.com/css/public_c.css?v=2018v1" type="text/css" rel="stylesheet"/>
  <link href="https://css.lianwen.com/css/index_2017.css" type="text/css" rel="stylesheet"/> -->
  <!-- <link rel="stylesheet" href="{{asset('asset/css/index.css')}}"> -->
  <link href="{{asset('asset/css/toast-min.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('asset/css/check.css')}}">
  <style>
    .curfont {
      font-size: 16px;
    }
    del { background: #FF4040; }
    ins { background: #00ff21;text-decoration:none; }
  </style>
@stop
@section('content')
  <!-- 推荐弹框结束 -->
    <!--左边导航-->
  <div>"xixixifdasssss</div>
@stop
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="{{ asset('asset/js/qrcode.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('asset/js/copy_cliboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('asset/js/diff.js') }}"></script>
  <script>
    $(() => {
      $('.navbar>div').removeClass('container').addClass('container-fluid')
      $('#headerlw').addClass('curfont')

      $('#freeadd').click(function(){
        $('#tjModal').modal('show')
      })
      $('#freeadds').click(function(){
        $('#tjModal').modal('show')
      })
      //生成分享二维码
      var qrcode = document.getElementById('qrcode')

      /*也可以配置二维码的宽高等*/
       var qrcodeObj = new QRCode('qrcode', {
          text: 'http://dev.cnweipu.com/zt/jc?uid='+{{auth()->user()->id}},
          width: 120,
          height: 120,
          colorDark: '#000000', //前景色
          colorLight: '#ffffff',//背景色
          correctLevel: QRCode.CorrectLevel.H
      })
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

      //获取字数
      $("#content").bind('input',(e)=>{
        $('#words span').html(e.target.value.length)
      })
      //增加降重次数
      $("#shopjctime").click(function(){
        $("#jctimeModal").modal('show')
      })
      $("#addjctimes").click(function(){
        $('#exampleModal').modal('hide')
        $("#jctimeModal").modal('show')
      })
      //点击增加降重次数
      $("#addjctime").click(function(){
        let current = Number($("#curjctime").text())+1;
        $("#curjctime").text(current)
      })
      //复制链接
      var clipboard = new Clipboard("#copybtn",{
        target:function(){
          return document.querySelector('#demo');
        }
      });
      clipboard.on('success', function(e) {
　　    console.log(e); //返回值类型给控制台 没什么用 可以注释掉
　　    toastr.success('复制成功');
      });
      //确认购买
      $("#sureshop").click(function(){
        let totalprice=$("#curjctime").text();
        console.log(totalprice,3131)
        axios.post('{{ route('recharges.store') }}',{
          total_amount:totalprice,
          amount:totalprice
        }).then(res => {
          let number = res.data.data.amount;
          let id =res.data.data.id;
          let price=res.data.data.total_amount;
          location.href=`/recharges/${id}`
        }).catch(err => {
          console.log(err,31312)
        })
      })
      })
      //点击减少降重次数
      $("#cutjctime").click(function(){
        let current = Number($("#curjctime").text());
        if(current==1) return;
        let cur =current-1;
        $("#curjctime").text(cur)
      })
      //点击降重
      $('#reduce').click(function(){
        let words =  $('#words span').text();
        let contents = $('#content').val();
        console.log(words,contents,31)
        if(words>1000){
          toastr.error('字数不能大于1000字');
          return
        }
        $('#exampleModal').modal('show')
      })
      //再来一篇
      $('#againjc').click(function(){
        window.location.reload()
      })
       //对比diff方法
       function changed(a,b,c) {
            var oldContent = a
            var content1 = b
            var diff = JsDiff['diffChars'](oldContent, content1);
      var arr = new Array();
      for (var i = 0; i < diff.length; i++) {
        if (diff[i].added && diff[i + 1] && diff[i + 1].removed) {
          var swap = diff[i];
          diff[i] = diff[i + 1];
          diff[i + 1] = swap;
        }
        var diffObj = diff[i];
        var content = diffObj.value;

        //可以考虑启用，特别是后台清理HTML标签后的文本
        if (content.indexOf("\n") >= 0) {

          var reg = new RegExp('\n', 'g');
          content = content.replace(reg, '<br/>');
        }
        if (diffObj.removed) {
          arr.push('<del title="删除的部分">' + content + '</del>');
        } else if (diffObj.added) {
          arr.push('<ins title="新增的部分">' + content + '</ins>');
        } else {
          //没有改动的部分
          arr.push('<span title="没有改动的部分">' + content + '</span>');
        }
      }
          var html = arr.join('');
          document.getElementById('content_after').innerHTML = html;

          document.getElementById('content_later').innerHTML = c;
        }
       //点击确认显示正在降重弹框
      $("#surecheck").click(function () {
        $('#exampleModal').modal('hide')
        $('#beingModal').modal('show')
        let num = 3;
        togetJc(num)
      })

      function togetJc(num){
        let contents = $('#content').val();
        axios.post('{{ route('ai_rewrite.store') }}',{content:contents})
          .then(res => {
            if(res.data.user.jc_times){
              console.log(res.data.user.jc_times,1323122321)
              $('#jc_timeend').html(res.data.user.jc_times)
            }
            $('#beingModal').modal('hide')
            $('#jcafter').css('display', 'none')
            var htmlstring=res.data.result.new_content;
            var stringtemp =htmlstring.replace(/<[^>]+>/g, "");
            changed(contents,stringtemp,htmlstring)

            $("#jclater").css('display', 'block')
          })
          .catch(err =>{
            num--;
            if(num>=0){
              togetJc(num)
              return;
            }else{
              $('#beingModal').modal('hide')
              toastr.error('降重失败，请重试');
            }
          }
          );
      }

  </script>
@stop
