@extends('layouts.app')
@section('title', '创建订单')
@section('styles')
  <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
@stop
@section('content')
  <div class="main clearfix">
    <div class="lbox fl">
      <form action="{{route('orders.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="cid" id="cid">

        <ul class="versionlist clearfix v4">
          @foreach($category as $item)
            <li data-id="{{ $item->id }}">
              <div class="version"><b>{{$item->name}}</b><span class="price">（{{$item->price}}元/{{\App\Models\Category::$priceTypeMap[$item->price_type]}}）</span>
              </div>
              完全免费，适用于初稿检测

            </li>

          @endforeach
        </ul>
        <div class="tips">
          <span>第一个</span>
          <span style="display: none">第2个</span>
        </div>

        <dl class="item">
          <dt>题目：</dt>
          <dd><input type="text" class="txt" name="title" placeholder="请输入论文题目"></dd>
        </dl>
        <dl class="item">
          <dt>作者：</dt>
          <dd><input type="text" class="txt" name="writer" placeholder="请输入论文作者"></dd>
        </dl>
        <dl class="item">
          <dt>方式：</dt>
          <dd style="padding-top:5px;"><input type="radio" name="radio" checked value="paste"> 粘贴文本 &emsp;<input
              type="radio" name="radio" value="upload"> 文件上传
          </dd>
        </dl>
        <dl class="item" id="paste">
          <dt>论文：</dt>
          <dd><textarea cols="10" name="content" class="txts"></textarea><br/>当前共输入 <em class="words"
                                                                                        style="color: red;font-family: normal">
              0 </em>字数
          </dd>
        </dl>
        <dl class="item" style="display: none;" id="upload">
          <input type="file" name="file">
        </dl>
        <div class="item"><input class="btn" type="submit" id="subBtn" value="提交检测"></div>
      </form>

    </div>

    <div class="rbox fr">
      <div class="tit">版本选择帮助</div>
      <div class="box">ffffffff</div>
      <div class="box mt10">
        <b>如何选择查重的版本？</b>
        <p>PaperYY论文查重的“免费版”包含论文常用库，对比库有限，查重比例偏低，适用于论文初稿查重，如果结果过低，建议使用更高版本的查重版本，至尊版查重最为全面，比知网还严格。</p>

        <b>如何正确标识参考文献？</b>
        <p>参考文献位于文章尾部，以“参考文献”四个单字单独成行，后面跟随标准的参考文献格式即可。</p>

        <b>查重比例与学校比差距大吗？</b>
        <p>从历史查重数据来看，“至尊版”查重的结果比例一般会比学校要高，所以如果你的至尊版查重结果低于学校要求，那么基本上可以定稿了。</p>

      </div>
    </div>

  </div>
@stop
@section('scripts')
  <script>
    $(() => {
      var formData = new FormData()
      $('.versionlist li:first').addClass('i-select')
      var cid = $('.versionlist li:first').data('id');
      $('#cid').val(cid);
      $(".versionlist li").click(function () {
        // var isshow = $(".tips").children('span'
        var index = $(this).index();
        cid = $(this).data('id');
        $('#cid').val(cid);
        $(this).addClass("i-select").siblings().removeClass("i-select");

        $('.tips').children('span').eq(index).show().siblings().hide();
      });
      $('input[type=radio][name=radio]').change(function () {
        if (this.value == 'paste') {
          $('#paste').show()
          $('#upload').hide()
        } else if (this.value == 'upload') {
          $('#paste').hide()
          $('#upload').show()
        }
      });
      $('.txts').bind('input propertychange', (e) => {
        $('.words').html(e.target.value.length)
      })
      {{--$('input[name=file]').change((e) => {--}}
      {{--  var file = e.target.files[0]--}}

      {{--  formData.append('file', file);--}}
      {{--})--}}
      {{--$('#subBtn').click(() => {--}}
      {{--  formData.append('cid', cid)--}}
      {{--  formData.append('title', $('input[name=title]').val())--}}
      {{--  formData.append('writer', $('input[name=writer]').val())--}}
      {{--  formData.append('content', $('textarea[name=content]').val())--}}
      {{--  axios.post('{{route('orders.store')}}', formData,--}}
      {{--    {--}}
      {{--      headers: {--}}
      {{--        'Content-Type':--}}
      {{--          'multipart/form-data'--}}
      {{--      }--}}
      {{--    }--}}
      {{--  ).then(res => {--}}
      {{--    location.href = '{{route('orders.show',['id'=>res.data.id])}}'--}}
      {{--  })--}}
      {{--})--}}

    })
  </script>
@stop

