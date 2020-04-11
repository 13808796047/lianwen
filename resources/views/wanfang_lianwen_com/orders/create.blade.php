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
  {{--  <div class="w-full px-8 mx-auto my-4 overflow-hidden">--}}
  {{--    <div class="row">--}}
  {{--      <div class="col-md-9">--}}
  {{--        <form action="{{route('orders.store')}}" method="post" enctype="multipart/form-data">--}}
  {{--          @csrf--}}
  {{--          <input type="hidden" name="cid" id="cid">--}}
  {{--          <input type="hidden" name="from" value="www.zcnki.com/PC端">--}}
  {{--          <div class="bg-white  overflow-hidden  shadow  p-4">--}}

  {{--            <div class="grid grid-cols-4 gap-4 category">--}}
  {{--              @foreach($category as $item)--}}
  {{--                <div data-id="{{ $item->id }}" class=" text-center border ">--}}
  {{--                  <div class="p-2">--}}
  {{--                    <span class="block  text-center ">{{$item->name}}</span>--}}
  {{--                    <span class="block text-orange-500 text-center  mt-2">（{{$item->price}}/{{\App\Models\Category::$priceTypeMap[$item->price_type]}})</span>--}}
  {{--                    <span class="block  text-center  mt-2">适合研究生论文检测.</span>--}}
  {{--                  </div>--}}
  {{--                </div>--}}
  {{--              @endforeach--}}
  {{--            </div>--}}
  {{--            <div class="my-8 px-0">--}}

  {{--              <div class="form-group">--}}
  {{--                <label for="title">题目</label>--}}
  {{--                <input type="text" class="form-control" id="title" name="title" required--}}
  {{--                       placeholder="请输入论文题目">--}}
  {{--              </div>--}}
  {{--              <div class="form-group">--}}
  {{--                <label for="writer">作者</label>--}}
  {{--                <input type="text" class="form-control col-sm-4" id="writer" name="writer" required--}}
  {{--                       placeholder="请输入论文作者">--}}
  {{--              </div>--}}
  {{--              <div class="form-group">--}}
  {{--                <div class="custom-control custom-radio custom-control-inline">--}}
  {{--                  <input type="radio" value="paste" id="paste-text" name="radio" checked class="custom-control-input">--}}
  {{--                  <label class="custom-control-label" for="paste-text">粘贴文本</label>--}}
  {{--                </div>--}}
  {{--                <div class="custom-control custom-radio custom-control-inline">--}}
  {{--                  <input type="radio" value="upload" name="radio" id="upload-file" class="custom-control-input">--}}
  {{--                  <label class="custom-control-label" for="upload-file">上传文件</label>--}}
  {{--                </div>--}}
  {{--              </div>--}}
  {{--              <div class="form-group" id="paste">--}}
  {{--                <label for="content">论文</label>--}}
  {{--                <textarea class="form-control" id="content" name="content" rows="10"></textarea>--}}
  {{--                <small id="words" class="form-text text-muted">当前共输入 <span class="text-red-500">0</span>个字</small>--}}
  {{--              </div>--}}
  {{--              <div class="form-group hidden" id="upload">--}}
  {{--                <label for="file">请上传论文docx文件或txt文件</label>--}}
  {{--                <input type="file" class="form-control-file" id="file" name="file">--}}
  {{--              </div>--}}
  {{--              <button type="submit" class="btn btn-primary px-10">提交</button>--}}
  {{--            </div>--}}
  {{--          </div>--}}
  {{--        </form>--}}
  {{--      </div>--}}
  {{--      <div class="col-md-3 shadow border px-0">--}}
  {{--        <div class="w-full ">--}}
  {{--          <h3 class="py-2 align-middle text-center bg-blue-500 text-white"> 版本选择帮助</h3>--}}
  {{--          <table class="table text-center">--}}
  {{--            <tr>--}}
  {{--              <th>系统名称</th>--}}
  {{--              <th>价格</th>--}}
  {{--              <th>语言支持</th>--}}
  {{--              <th>检测结果</th>--}}
  {{--            </tr>--}}
  {{--            <tr>--}}
  {{--              <td>联文普通版</td>--}}
  {{--              <td>3元/万字</td>--}}
  {{--              <td>中文/英文</td>--}}
  {{--              <td>一般</td>--}}
  {{--            </tr>--}}
  {{--            <tr>--}}
  {{--              <td>联文专业版</td>--}}
  {{--              <td>1.5元/千字</td>--}}
  {{--              <td align="center">中文/英文</td>--}}
  {{--              <td align="center">严格</td>--}}
  {{--            </tr>--}}
  {{--            <tr>--}}
  {{--              <td>PaperPass</td>--}}
  {{--              <td>1.8元/千字</td>--}}
  {{--              <td align="center">中文</td>--}}
  {{--              <td align="center">中等</td>--}}
  {{--            </tr>--}}

  {{--          </table>--}}
  {{--          <p class="px-4 text-red-500">推荐使用“联文专业版”，性价比最高，检测结果准确。</p>--}}
  {{--        </div>--}}
  {{--        <div class="mt-2 px-4">--}}
  {{--          <div class="py-2">--}}
  {{--            <b>1、怎么选择适合自己的论文检测系统？</b>--}}
  {{--            <p>只有使用和学校相同的数据库，才能保证重复率与学校、杂志社100%一致：<br>论文初次修改可使用联文检测、PaperPass，定稿再使用与学校一样的系统。</p>--}}
  {{--          </div>--}}
  {{--          <div class="py-2">--}}
  {{--            <b>2、检测要多长时间，报告怎么还没出来？</b>--}}
  {{--            <p>正常检测20分钟左右，毕业高峰期，服务器检测压力大，时间会有延长，请大家提前做好时间准备。超过2小时没出结果可以联系客服处理！</p>--}}
  {{--          </div>--}}
  {{--          <div class="py-2">--}}
  {{--            <b>3、同一篇论文可以多次检测吗？？</b>--}}
  {{--            <p>本站不限制论文检测次数，但检测一次需支付一次费用。</p>--}}
  {{--          </div>--}}
  {{--          <div class="py-2">--}}
  {{--            <b>4、检测报告有网页版、pdf格式的吗？</b>--}}
  {{--            <p>检测完成后会提供网页版和pdf格式的检测报告，报告只是格式不同，重复率都一样的。</p>--}}
  {{--          </div>--}}
  {{--        </div>--}}
  {{--      </div>--}}
  {{--    </div>--}}
  {{--  </div>--}}
  <div class="ontainer mx-auto p-4 mb-24">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-5 p-4" style="box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);">
        <ul class=" category">
          @foreach($category as $item)
            <li class="float-left position-relative mr-4 "
                data-id="{{ $item->id }}">
              <i class="position-absolute hidden"><img src="{{ asset('asset/images/icon-y.png') }}"
                                                       class="img-fluid"
                                                       alt=""></i>
              <a href="javascript:;" class="icon-img checkpro-1">
                <img src="http://check.lianwen.com/lianwen//2019/05/21/201905212329404176868.png" alt=""
                     class="img-fluid">
              </a>
              <p class="text-center text-xs py-2">
                <span>{{$item->name}}</span>
                <br>
                <b class="text-danger">{{ $item->price }}</b>
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
              <input id="title" type="text" name="title" class="form-control" placeholder="必须填写，在检测报告中显示"
                     maxlength="128" required="" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group mt-3">
              <div class="input-group-prepend">
                <span class="input-group-text">论文作者</span>
              </div>
              <input id="writer" type="text" name="writer" class="form-control" placeholder="必须填写，在检测报告中显示"
                     maxlength="128" required="" autocomplete="off">
            </div>
          </div>
          <div class="mt-3">
            <ul class="nav nav-tabs tab-list" role="tablist" id="navbarText">
              <li class="nav-item">
                <a class="nav-link active list-fw fw-a" data-contenttype="file" data-toggle="tab" href="#contentfile">上传文档</a>
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
                  <input type="file" class="custom-file-input" id="customFile" lang="cn" name="file">
                  <label class="custom-file-label" for="customFile" data-browse="选择文件"></label>
                </div>
                <p class="text-xs">支持文档格式：DOC,DOCX,TXT</p>
              </div>
              <div id="contenttext" class="tab-pane fade">
                <br>
                <p class="text-xs">
                  <img class="inline-block" src="http://check.lianwen.com/portal/weipu/static2/images/icon-01.png"
                       alt="">
                  系统在检测时会分析论文的前后文关系， 所以请您提交论文的全部内容，如果是非全文的检测将不能保证检测的准确性。
                </p>
                <div class="form-group">
                  <textarea id="content" class="form-control" name="content" placeholder="输入论文内容不少于1000字"
                            minlength="256" rows="10"></textarea>

                </div>
                <p id="words" class="text-right">共输入<span class="text-red-500">0</span>字</p>
              </div>
            </div>
          </div>
          <input type="submit" value="提交论文" class="btn btn-danger my-4 px-8">
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

