@extends('domained::layouts.app')
@section('title', '创建订单')
@section('styles')
  <style>
    .selected {
      display: block;
    }
  </style>
@stop
@section('content')
  <div class="p-4 mb-24">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-5 p-4" style="box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);">
        <ul class=" category">
          @foreach($categories as $item)
            <li class="float-left position-relative mr-4 "
                data-id="{{ $item->id }}">
              <i class="position-absolute hidden"><img src="{{ asset('asset/images/icon-y.png') }}"
                                                       class="img-fluid"
                                                       alt=""></i>
              <a href="javascript:;" class="icon-img checkpro-1">
                <img src="{{$item->sys_logo}}" alt=""
                     class="img-fluid">
              </a>
              <p class="text-center text-xs py-2">
                <span>{{$item->name}}</span>
                <br>
                @switch(auth()->user()->user_group)
                  @case(3)
                  <b class="text-danger">{{ count($item->users) ? $item->users[0]->pivot->price : $item->price }}</b>
                  @break
                  @case(2)
                  <b class="text-danger">{{ $item->agent_price2 }}</b>
                  @break
                  @case(1)
                  <b class="text-danger">{{ $item->agent_price1 }}</b>
                  @break
                  @default
                  <b class="text-danger">{{ $item->price }}</b>
                @endswitch

                <span>({{\App\Models\Category::$priceTypeMap[$item->price_type]}})</span>
              </p>
            </li>
          @endforeach
        </ul>
        <form action="{{route('orders.store')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="cid" id="cid">
          <input type="hidden" name="from" value="万方PC端">
          <div class="form-group">
            <div class="input-group mt-3">
              <div class="input-group-prepend">
                <span class="input-group-text">论文标题</span>
              </div>
              <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                     placeholder="必须填写，在检测报告中显示" value="{{ old('title') }}"
              >
              @error('title')
              <span class="invalid-feedback" role="alert" style="display:block;">
                                        <strong>{{ $message }}</strong>
               </span>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <div class="input-group mt-3">
              <div class="input-group-prepend">
                <span class="input-group-text">论文作者</span>
              </div>
              <input id="writer" type="text" name="writer" class="form-control @error('writer') is-invalid @enderror"
                     placeholder="必须填写，在检测报告中显示" value="{{ old('writer') }}"
              >
              @error('writer')
              <span class="invalid-feedback" role="alert" style="display:block;">
                                        <strong>{{ $message }}</strong>
               </span>
              @enderror
            </div>
          </div>
          <div class="mt-3">
            <ul class="nav nav-tabs tab-list" role="tablist" id="navbarText">
              <li class="nav-item">
                <a class="nav-link active list-fw fw-a" data-contenttype="file" data-toggle="tab"
                   href="#contentfile">上传文档</a>
              </li>
              <li class="nav-item">
                <a class="nav-link list-fw" data-contenttype="text" data-toggle="tab" href="#contenttext">粘贴文本</a>
              </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div id="contentfile" class="tab-pane active">
                <br>
                <p class="text-xs">
                  <img class="inline-block" src="http://check.lianwen.com/portal/weipu/static2/images/icon-01.png"
                       alt="">
                  系统在检测时会分析论文的前后文关系， 所以请您提交论文的全部内容，如果是非全文的检测将不能保证检测的准确性。
                </p>
                <div class="custom-file my-2">
                  <input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="customFile"
                         lang="cn" name="file"
                  >
                  @error('file')
                  <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
               </span>
                  @enderror
                  <label class="custom-file-label" for="customFile" data-browse="选择文件"></label>
                </div>
                <p class="text-xs">支持文档格式：DOCX,TXT</p>
              </div>
              <div id="contenttext" class="tab-pane fade">
                <br>
                <p class="text-xs">
                  <img class="inline-block" src="http://check.lianwen.com/portal/weipu/static2/images/icon-01.png"
                       alt="">
                  系统在检测时会分析论文的前后文关系， 所以请您提交论文的全部内容，如果是非全文的检测将不能保证检测的准确性。
                </p>
                <div class="form-group">
                  <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content"
                            placeholder="输入论文内容不少于1000字"
                            rows="10" value="{{ old('content') }}"></textarea>
                  @error('content')
                  <span class="invalid-feedback" role="alert" style="display: block">
                                        <strong>{{ $message }}</strong>
               </span>
                  @enderror
                </div>
                <p id="words" class="text-right">共输入<span class="text-red-500">0</span>字</p>
              </div>
            </div>
          </div>
          <input type="submit" value="提交论文" class="btn btn-danger my-4 px-8" onclick="checkType()">
        </form>
      </div>
      <div class="col-span-1 p-4" style="box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);">
        <dl class="problem text-sm">
          <dt>常见问题</dt>
          <dd>
            <a>可以检测哪些类别的文章？</a>
          </dd>
          <dd>
            <a>比对指纹数据库有哪些？</a>
          </dd>
          <dd>
            <a>单次最多可以提交多少字？</a>
          </dd>
          <dd>
            <a>检测的论文是否会被添加到对比数据库？</a>
          </dd>
          <dd>
            <a>提交论文后多久能够获得检测报告？</a>
          </dd>
        </dl>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  <script>
    $(() => {
      $('.navbar>div').removeClass('container').addClass('container-fluid')
      $('.category>li:first-child i').addClass('selected')
      $('#cid').val($('.category>li:first-child').data('id'))
      $('.category>li').click(function () {
        $(this).siblings().children('i').removeClass('selected')
        $(this).children('i').addClass('selected')
        $('#cid').val($(this).data('id'))
      })
      $('#content').bind('input propertychange', (e) => {
        $('#words span').html(e.target.value.length)
      })
      $('#customFile').change(function (e) {
        $('.custom-file-label').html(e.target.files[0].name)
      })

      // function checkType(e) {
      //   var ext = $('#customFile').val().split('.').pop().toLowerCase();
      //   if ($.inArray(ext, ['docx', 'txt']) == -1) {
      //     alert('不允许上传文件类型!');
      //   }
      // }

      // var formData = new FormData()
      // $('.versionlist li:first').addClass('i-select')
      // var cid = $('.versionlist li:first').data('id');
      // $('#cid').val(cid);
      // $(".versionlist li").click(function () {
      //   // var isshow = $(".tips").children('span'
      //   var index = $(this).index();
      //   cid = $(this).data('id');
      //   $('#cid').val(cid);
      //   $(this).addClass("i-select").siblings().removeClass("i-select");
      //
      //   $('.tips').children('span').eq(index).show().siblings().hide();
      // });
      // $('input[type=radio][name=radio]').change(function () {
      //   if (this.value == 'paste') {
      //     $('#paste').show()
      //     $('#upload').hide()
      //   } else if (this.value == 'upload') {
      //     $('#paste').hide()
      //     $('#upload').show()
      //   }
      // });
      // $('.txts').bind('input propertychange', (e) => {
      //   $('.words').html(e.target.value.length)
      // })
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

