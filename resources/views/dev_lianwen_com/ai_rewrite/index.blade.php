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
  <!-- alert提示框 -->

  <!-- 模态框 -->
  <div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">提示</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align:center;">
          <p>本次操作将消耗1次降重次数</p>
          <p>剩余次数：{{ auth()->user()->jc_times}}<span style="color:#4876FF;margin-left:10px;" id="addjctimes">增加次数</span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary" id="surecheck">确定</button>
        </div>
      </div>
    </div>
  </div>
  <!-- 模态框结束 -->
   <!-- 模态框2 -->
   <div class="modal fade bd-example-modal-sm" id="beingModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-body" style="text-align:center;">
          <div style="padding:20px 0">正在降重中，请勿刷新页面</div>
        </div>
      </div>
    </div>
  </div>
  <!-- 模态框2结束-->
  <!-- 购买降重字数模态框 -->
  <div class="modal fade bd-example-modal-sm" id="jctimeModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">提示</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align:center;">
          <p>购买自动降重次数</p>
          <p style="margin: 6px 0;font-size: 11px;color: #F4A460;">(价格:1元/次)</p>
          <p>请输入购买次数<span style="padding:0 10px;" id="cutjctime">-</span><span style="border: 1px solid;padding: 3px;" id="curjctime">1</span><span style="padding:0 10px;" id="addjctime">+</span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary" id="sureshop">确定</button>
        </div>
      </div>
    </div>
  </div>
  <!-- 购买降重字数模态框结束 -->
  <!-- 推荐弹框 -->
  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="tjModal">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header" style="padding:5px 10px;border-bottom:0;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding:0;text-align:center;">
          <p style="font-weight: bold;font-size: 18px;">推荐注册，赠送自动降重次数</p>
          <p style="font-size: 13px;color: #FFA54F;">双方各送5次</p>
          <p style="margin:10px 0;">方式1：分享地址，邀请好友注册（适合电脑此操作）</p>
          <div style="display:flex;justify-content: center;">
            <p id="demo" style="border: 1px solid;padding: 0 10px;" >https://dev.lianwen.com/zt/jc?uid={{auth()->user()->id}}</p>
            <p style="margin-left: 10px;background: red;color: #fff;padding: 0 10px;" class="btn" id="copybtn" >复制链接</p>
          </div>
          <p style="margin:10px 0;">方式2：微信扫码，邀请好友注册（适合手机操作）</p>
          <div style="display:flex;justify-content: center;" id="qrcode">

          </div>
          <p style="font-size: 13px;margin-top: 5px;">微信扫码分享</p>
        </div>
        <div class="modal-footer" style="border:none;display:block;font-size:13px;">
          <p>活动规则</p>
          <p>1、每推荐1名好友成功注册（微信登录或绑定手机号），推荐人和注册人各获得5次自动降重次数，获得的次数可叠加，无上限；</p>
          <p>2、所获得降重次数不可提现，仅用于使用自动降重服务时抵扣；</p>
          <p>3、严禁使用非法手段获取，对于问题账号本站有权撤销相应数据或封禁账号。</p>
        </div>
    </div>
  </div>
</div>
  <!-- 推荐弹框结束 -->
    <!--左边导航-->
    <div class="main clearfix" id="jcafter">
      <div class="lbox fl">
      <p style="font-size: 20px;">请输入你要降重的内容。<span style="font-size:16px;color:#757575;">（最大支持1000字）</span></p>
      <textarea name="content" id="content"
        style="width:97%;height: 500px;padding:20px;box-sizing:border-box;font-size:20px;outline: none;border:1px solid #ddd;margin-top:20px"></textarea>
      <div style="display:flex;align-items: center;justify-content: space-between;">
      <p style="background-color: #4876FF;display: inline;padding: 5px 20px;color:#fff;text-align: center;font-size:15px;"
        id="reduce">
        一键降重</p>
        <p style="float: right;font-size: 13px;padding-right: 30px;" id="words">当前输入<span>0</span>字</p>
      </div>
      <div style="display: flex;justify-content: center;margin-top: 15px;">
      <p>剩余次数:<span id="jc_time">{{ auth()->user()->jc_times}}</span></p><span style="color:#4876FF;margin-left: 10px;" id="shopjctime">增加次数</span>
    </div>
    </div>
    <!--右边内容-->
    <div class="rbox fr" style="min-height:900px;">
      <div class="box">
        <b>1、工具说明</b>
        <p>本工具具有强大的自然语言语义分析能力，通过自主研发的中文分词、句法分析、语义联想和实体识别技术，结合海量行业语料，在不改变原文语义的情况下对原文进行替换和重组，从而达到降低文章重复率的效果。</p>
        <b>2、使用方法</b>
        <p>将需要降重的论文粘贴到输入框，点击“一键降重”即可，系统处理完成后会将删减过的文字以红色背景标出，新增文字为绿色背景。然后要将降重后的内容读一遍，修改通顺后插入到论文原来的位置即可。</p>
        <b>3、注意问题</b>
        <p>本工具一次最大支持1000字，10个段落以内，多个段落会导致降重失败。</p>
        <b>4、会不会记录我的论文</b>
        <p>本工具实时处理，所有内容均不保存数据库，用户需要自己保存结果，关闭页面后无法找回。</p>
        <b>5、专业的人工降重服务</b>
        <p>联系微信：13878811985</p>
      </div>
    </div>
    </div>
    <!-- 降重成功后 -->
    <div style="padding: 21px; display: none;min-height:800px;" id="jclater">
    <div style="display: flex;">
      <!-- <div style="width: 50%;">
        <p style="font-size: 17px;font-weight: bold;">降重前</p>
        <textarea name="" id="content_after"
          style="width:100%;height: 550px;box-sizing: border-box;overflow-x:visible;border:1px solid #ccc;outline: none;"></textarea>
      </div>
      <div style="width: 50%;">
        <p style="font-size: 17px;font-weight: bold;">降重后</p>
        <textarea name="" id="content_later" style="width: 100%;height: 550px;border: none;outline: none;border:1px solid #ccc"
          readonly></textarea>
      </div> -->
      <table style="width:100%;">
        <tr>
            <td style="width:48%;">
              <div style="font-size:19px;font-weight:bold;margin-left:10px;">降重前</div>
              <div style="height:650px;overflow-y:auto;background:#fff;border: 1px solid #ddd;padding: 19px;margin-right:5px;" id="content_after">
              </div>
            </td>
            <td style="width:48%;">
              <div style="font-size:19px;font-weight:bold;margin-left:10px;">降重后</div>
              <div style="height:650px;overflow-y:auto;background:#fff;border: 1px solid #ddd;padding: 19px;margin-left:5px;" id="content_later">
              </div>
            </td>
        </tr>
      </table>
    </div>
    <p style="font-size: 13px;margin-top: 10px;text-align: center;">
      注：本工具是通过运用AI技术对原文进行降重，结果仅供参考，需要稍作调整让语句更通顺。如需高质量人工降重请联系微信：13878811985
    </p>
    <p style="background-color: #4876FF;padding: 5px 20px;color:#fff;text-align: center;margin:0 auto;width:100px;margin-top:16px;" id="againjc">
      再来一篇</p>
    <div style="display: flex;justify-content: center;margin-top: 15px;">
      <p>剩余次数:<span id="jc_time"></span></p><span style="color:#4876FF;margin-left: 10px;" id="shopjctime">增加次数</span>
    </div>
  </div>
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
      $('#tjModal').modal('show')
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

        "showDuration": "300000",//显示的动画时间

        "hideDuration": "500000",//消失的动画时间

        "positionClass": "toast-center-center",//弹出窗的位置

        "timeOut": "500000", //展现时间

        "extendedTimeOut": "100000",//加长展示时间

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
      //复制成功执行的回调
      clipboard.on('success', function(e) {
　　    console.log(e); //返回值类型给控制台 没什么用 可以注释掉
　　    alert("复制成功，去粘贴看看吧！");
      });
      //确认购买
      $("#sureshop").click(function(){
        let totalprice=$("#curjctime").text();
        console.log(totalprice,3131)
        axios.post('{{ route('recharges.store') }}',{
          total_amount:totalprice,
          amount:totalprice
        }).then(res => {
          console.log(res,312312)
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
        if(words>5000){
          alert('字数大于1000')
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
        console.log(diff[i]);
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
            console.log(res,1323122321)
            $('#beingModal').modal('hide')
            $('#jcafter').css('display', 'none')
            var htmlstring=res.data.result.new_content;
            var stringtemp =htmlstring.replace(/<[^>]+>/g, "");
            changed(contents,stringtemp,htmlstring)
            $('#jc_time').html(res.data.user.jc_times)
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
