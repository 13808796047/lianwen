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
          <span>剩余次数：100</span>
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
@stop
@section('scripts')
  <script>
    $(() => {
      $('.navbar>div').removeClass('container').addClass('container-fluid')
      $('#headerlw').addClass('curfont')
      //获取字数
      $("#content").bind('input',(e)=>{
        $('#words span').html(e.target.value.length)
      })
      //点击降重
      $('#reduce').click(function(){
        let words =  $('#words span').text();
        let contents = $('content').text()
        console.log(words,31)
        if(words>5000){
          alert('字数大于5000')
          return
        }
        axios.post('{{ route('auto_check.store') }}',{content:contents}).then(res => {
          console.log(res, 3123123)
        }).catch(err => {
          console.log(err,312)
        })
      })
    })
  </script>
@stop
