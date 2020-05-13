@extends('domained::layouts.app')
@section('title','智能查重')
@section('styles')
  <!-- <link href="https://css.lianwen.com/css/public_c.css?v=2018v1" type="text/css" rel="stylesheet"/>
  <link href="https://css.lianwen.com/css/index_2017.css" type="text/css" rel="stylesheet"/> -->
  <!-- <link rel="stylesheet" href="{{asset('asset/css/index.css')}}"> -->
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
          <span>剩余次数：{{ auth()->user()->jc_times}}</span>
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
    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <!--左边导航-->
    <div class="main clearfix" id="jcafter">
      <div class="lbox fl">
      <p style="font-size: 20px;">请输入你要降重的内容。<span style="font-size:16px;color:#757575;">（最大支持5000字）</span></p>
      <textarea name="content" id="content"
        style="width:97%;height: 500px;padding:20px;box-sizing:border-box;font-size:20px;outline: none;border:1px solid #ddd;margin-top:20px"></textarea>
      <p style="float: right;font-size: 13px;padding-right: 30px;" id="words">当前输入<span>0</span>字</p>
      <p style="background-color: #4876FF;display: inline;padding: 5px 20px;color:#fff;text-align: center;font-size:15px;"
        id="reduce">
        一键降重</p>
    </div>
    <!--右边内容-->
    <div class="rbox fr" style="min-height:900px;">
      <div class="box">
        <b>1、检测结果是否准确？</b>
        <p>如果你们学校也是用万方检测，那结果是一致的。同一个的系统、同样的比对库、同样的算法，所以只要在本系统提交的内容和学校的一致，那检测结果是一致的。</p>
        <b>2、检测需要多少时间？</b>
        <p>正常情况，万方检测需要10分钟左右，高峰期可能会延迟，但不会超过1个小时，如果长时间未出结果请联系客服微信：cx5078解决。</p>
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
    <!-- 降重成功后 -->
    <div style="padding: 50px; display: none;min-height:1000px;" id="jclater">
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
      <table>
        <tr>
            <td style="width:48%;">
              <div>降重前</div>
              <div style="height:500px;overflow-y:auto;background:#fff;border: 1px solid #ddd;padding: 19px;margin-right:5px;" id="content_after">
              </div>
            </td>
            <td style="width:48%;">
              <div>降重后</div>
              <div style="height:500px;overflow-y:auto;background:#fff;border: 1px solid #ddd;padding: 19px;" id="content_later">
              </div>
            </td>
        </tr>
      </table>
    </div>
    <p style="font-size: 13px;margin-top: 10px;text-align: center;">
      注：本工具是通过运用AI技术对原文进行降重，结果仅供参考，需要稍作调整让语句更通顺。如需高质量人工降重请联系微信：13878811985
    </p>
    <p style="background-color: #4876FF;padding: 5px 20px;color:#fff;text-align: center;margin:0 auto;width:100px;">
      再来一篇</p>
    <div style="display: flex;justify-content: center;margin-top: 15px;">
      <p>剩余次数:<span id="jc_time"></span></p><span style="color:#4876FF;margin-left: 10px;" id="shopjctime">增加次数</span>
    </div>
  </div>
@stop
@section('scripts')
<script type="text/javascript" src="{{ asset('asset/js/diff.js') }}"></script>
  <script>
    $(() => {
      $('.navbar>div').removeClass('container').addClass('container-fluid')
      $('#headerlw').addClass('curfont')
      //获取字数
      $("#content").bind('input',(e)=>{
        $('#words span').html(e.target.value.length)
      })
      //增加降重次数
      $("#shopjctime").click(function(){
        $("#jctimeModal").modal('show')
      })
      //点击增加降重次数
      $("#addjctime").click(function(){
        let current = Number($("#curjctime").text())+1;
        $("#curjctime").text(current)

      })
      //确认购买
      $("#sureshop").click(function(){
        let totalprice=$("#curjctime").text();
        console.log(totalprice,3131)
        axios.post('{{ route('recharges.store') }}',{
          total_amount:totalprice,
          amount:totalprice
        }).then(res => {
          console.log(res,312312)
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
          alert('字数大于5000')
          return
        }
        // axios.post('{{ route('auto_check.store') }}',{content:contents})
        //   .then(res => {
        //     let id = res.data.data.id;
        //     let timer = setInterval(() => {
        //       axios('/auto_check/' + id).then(resp => {
        //         // debugger;
        //         if (resp.data.autoCheck.content_after) {
        //           // clear timer
        //           clearInterval(timer);
        //           console.log(resp);
        //         }
        //       })
        //     }, 1000);
        //   })
        //   .catch(err => console.log(err));
        $('#exampleModal').modal('show')
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
        // setInterval(() => {
        //   $('#beingModal').modal('hide')
        //   $('#jcafter').css('display', 'none')
        //   $("#jclater").css('display', 'block')
        // }, 3000);
        let contents = $('#content').val();
        axios.post('{{ route('auto_check.store') }}',{content:contents})
          .then(res => {
            console.log(res,1323122321)
            $('#beingModal').modal('hide')
            $('#jcafter').css('display', 'none')

            // $("#content_later").html(res.data.result.new_content)
            //去除html标签
            var htmlstring=res.data.result.new_content;
            var stringtemp =htmlstring.replace(/<[^>]+>/g, "");
            changed(contents,stringtemp,htmlstring)
            $('#jc_time').html(res.data.user.jc_times)
            $("#jclater").css('display', 'block')
            // let id = res.data.data.id;
            // let timer = setInterval(() => {
            //   axios('/auto_check/' + id).then(resp => {
            //     // debugger;
            //     if (resp.data.data.content_after) {
            //       // clear timer
            //       clearInterval(timer);
            //       console.log(resp);
            //       $('#beingModal').modal('hide')
            //       $('#jcafter').css('display', 'none')
            //       $("#content_after").text(resp.data.data.content_before)
            //       $("#content_later").text(resp.data.data.content_after)
            //       $('#jc_time').html(resp.data.data.jc_times)
            //       $("#jclater").css('display', 'block')
            //     }
            //   })
            // }, 1000);
          })
          .catch(err => console.log(err));
          })
    })
  </script>
@stop
