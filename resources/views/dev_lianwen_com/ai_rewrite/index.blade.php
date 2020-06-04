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

  <!-- 模态框结束 -->
   <!-- 模态框2 -->

  <!-- 模态框2结束-->
  <!-- 购买降重字数模态框 -->

  <!-- 购买降重字数模态框结束 -->
  <!-- 推荐弹框 -->

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

    </div>
    </div>
    <!--右边内容-->
    <div class="rbox fr" style="min-height:900px;font-size:14px;">
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
        <div style="height:247px;"></div>
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
      <p>剩余次数:<span id="jc_timeend"></span></p>
      <span style="color:#4876FF;margin-left: 10px;" id="shopjctime">增加次数</span>
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
  </script>
@stop
