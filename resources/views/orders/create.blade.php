@extends('layouts.app')
@section('title', '创建订单')
@section('styles')
  <style>
    .selected {
      border: #FE5D33 2px solid !important;
      background: url({{asset('asset/images/select.png')}}) no-repeat right top;
      color: #FE5D33 !important;
    }
  </style>
@stop
@section('content')
  <div class="w-full px-8 mx-auto my-4 overflow-hidden">
    <div class="row">
      <div class="col-md-9">
        <form action="{{route('orders.store')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="cid" id="cid">
          <input type="hidden" name="from" value="dev.lianwen.com/PC端">
          <div class="bg-white  overflow-hidden  shadow  p-4">

            <div class="grid grid-cols-4 gap-4 category">
              @foreach($category as $item)
                <div data-id="{{ $item->id }}" class=" text-center border ">
                  <div class="p-2">
                    <span class="block  text-center ">{{$item->name}}</span>
                    <span class="block text-orange-500 text-center  mt-2">（{{$item->price}}/{{\App\Models\Category::$priceTypeMap[$item->price_type]}})</span>
                    <span class="block  text-center  mt-2">适合研究生论文检测.</span>
                  </div>
                </div>
              @endforeach
            </div>
            <div class="my-8 px-0">

              <div class="form-group">
                <label for="title">题目</label>
                <input type="text" class="form-control" id="title" name="title" required
                       placeholder="请输入论文题目">
              </div>
              <div class="form-group">
                <label for="writer">作者</label>
                <input type="text" class="form-control col-sm-4" id="writer" name="writer" required
                       placeholder="请输入论文作者">
              </div>
              <div class="form-group">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="paste" id="paste-text" name="radio" checked class="custom-control-input">
                  <label class="custom-control-label" for="paste-text">粘贴文本</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="upload" name="radio" id="upload-file" class="custom-control-input">
                  <label class="custom-control-label" for="upload-file">上传文件</label>
                </div>
              </div>
              <div class="form-group" id="paste">
                <label for="content">论文</label>
                <textarea class="form-control" id="content" name="content" rows="10"></textarea>
                <small id="words" class="form-text text-muted">当前共输入 <span class="text-red-500">0</span>个字</small>
              </div>
              <div class="form-group hidden" id="upload">
                <label for="file">请上传论文doc文件或txt文件</label>
                <input type="file" class="form-control-file" id="file" name="file">
              </div>
              <button type="submit" class="btn btn-primary">提交</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-3 shadow border px-0">
        <div class="w-full ">
          <h3 class="py-2 align-middle text-center bg-blue-500 text-white"> 版本选择帮助</h3>
          <table class="table text-center">
            <tr>
              <th>系统名称</th>
              <th>价格</th>
              <th>语言支持</th>
              <th>检测结果</th>
            </tr>
            <tr>
              <td>联文普通版</td>
              <td>3元/万字</td>
              <td>中文/英文</td>
              <td>一般</td>
            </tr>
            <tr>
              <td>联文专业版</td>
              <td>1.5元/千字</td>
              <td align="center">中文/英文</td>
              <td align="center">严格</td>
            </tr>
            <tr>
              <td>PaperPass</td>
              <td>1.8元/千字</td>
              <td align="center">中文</td>
              <td align="center">中等</td>
            </tr>

          </table>
          <p class="px-4 text-red-500">推荐使用“联文专业版”，性价比最高，检测结果准确。</p>
        </div>
        <div class="mt-2 px-4">
          <div class="py-2">
            <b>1、怎么选择适合自己的论文检测系统？</b>
            <p>只有使用和学校相同的数据库，才能保证重复率与学校、杂志社100%一致：<br>论文初次修改可使用联文检测、PaperPass，定稿再使用与学校一样的系统。</p>
          </div>
          <div class="py-2">
            <b>2、检测要多长时间，报告怎么还没出来？</b>
            <p>正常检测20分钟左右，毕业高峰期，服务器检测压力大，时间会有延长，请大家提前做好时间准备。超过2小时没出结果可以联系客服处理！</p>
          </div>
          <div class="py-2">
            <b>3、同一篇论文可以多次检测吗？？</b>
            <p>本站不限制论文检测次数，但检测一次需支付一次费用。</p>
          </div>
          <div class="py-2">
            <b>4、检测报告有网页版、pdf格式的吗？</b>
            <p>检测完成后会提供网页版和pdf格式的检测报告，报告只是格式不同，重复率都一样的。</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  <script>
    $(() => {
      $('.category>div:first').addClass('selected')
      $('#cid').val($('.category>div:first').data('id'))
      $('.category>div').click(function () {
        $(this).addClass('selected').siblings().removeClass('selected')
        $('#cid').val($(this).data('id'))
      })
      $('input[type=radio][name=radio]').change(function () {
        if (this.value == 'paste') {
          $('#paste').show()
          $('#upload').hide()
        } else if (this.value == 'upload') {
          $('#paste').hide()
          $('#upload').show()
        }

      });
      $('#content').bind('input propertychange', (e) => {
        $('#words span').html(e.target.value.length)
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

