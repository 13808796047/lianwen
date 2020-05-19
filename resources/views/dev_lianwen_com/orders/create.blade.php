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
<!-- alert弹框 -->
<div class="modal fade bd-example-modal-sm" id="alertbot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding:7px;">
        <h5 class="modal-title" id="exampleModalLabel">提示</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding:0;margin:0;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="model-body-container"></p>
      </div>
    </div>
  </div>
</div>
  <!-- alert弹框结束 -->
 <!-- 二维码弹窗 -->
 <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
 id="lwqrcode" >
	<div class="modal-dialog modal-dialog-centered" role="document" style="width:650px;">
		<div class="modal-content" >
			<div class="modal-header" style="border-bottom: none;padding-top: 0;padding-bottom: 0;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<p style='font-size: 16px;font-weight: bold;text-align: center;'>添加微信提醒</p>
			<div style="width: 200px;height: 200px;margin: 0 auto;">
      <img src="" id="qrimg">
			</div>
			<p style="text-align: center;font-size: 13px;margin-bottom: 5px;color:#FFA500;">提示：系统检测到您未添加微信提醒，请使用手机扫描以上二维码关注</p>
      <p style="font-size:13px;text-align:center;margin-bottom:5px;">关注公众号以后您可以及时收到检测完成通知，同时可以在手机上查看检测报告</p>
		</div>
	</div>
</div>
  <!-- 二维码弹窗结束 -->
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
        <form >
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
          <input type="button" value="提交论文" class="btn btn-danger my-4 px-8" id="tosubmit">
          <button class="btn btn-danger" type="button" disabled style="display:none;margin:20px 0" id="submitBtn">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            正在提交
          </button>
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
<script type="text/javascript" src="{{ asset('asset/js/jquery-cxcalendar.js') }}"></script>
  <script>
    $(() => {
      @unless(Auth::user()->weixin_openid)
      axios.get('{{ route('official_account.index') }}').then(res => {
        //   swal({
        //   //   $('#wximg').attr('src', res.data.url)
        //   // // swal({
        //   // $('#staticBackdrop').modal('show')
        //   // //   // content 参数可以是一个 DOM 元素，这里我们用 jQuery 动态生成一个 img 标签，并通过 [0] 的方式获取到 DOM 元素
        //   // //   content: $('<img src="' + res.data.url + '" style="display: block;margin: 0 auto;"/>')[0],
        //   // // })
        //   content: $('<img src="' + res.data.url + '" style="display: block;margin: 0 auto;"/>')[0]
        // })
        // content 参数可以是一个 DOM 元素，这里我们用 jQuery 动态生成一个 img 标签，并通过 [0] 的方式获取到 DOM 元素
        $('#qrimg').attr("src",res.data.url)
        $("#lwqrcode").modal('show');

      })
      @endunless
    let set = new Set();
    let name = '';
    var oneid = ''
    $('.navbar>div').removeClass('container').addClass('container-fluid')
    $('#headerlw').addClass('curfont')
    $('.category>li:first-child i').addClass('selected')
    $('#cid').val($('.category>li:first-child').data('id'))
    $('.category>li').click(function () {
      $(this).siblings().children('i').removeClass('selected')
      $(this).children('i').addClass('selected')
      $('#cid').val($(this).data('id'))
      if($(this).data('id')==6){
            $('#element_id').val(getNowFormatDate())
            $('#isfbtime').css('display','block')
        }else{
            $('#isfbtime').css('display','none')
            $('#element_id').val('')
        }
    })
    $('#content').bind('input propertychange', (e) => {
      $('#words span').html(e.target.value.length)
    })
    //  //时间选择
    //  $('#element_id')[0].dataset.startDate = '2000/1/1'
    //   $('#element_id')[0].dataset.endDate = getNowFormatDate()
    //   $('#element_id').cxCalendar();
    //   function getNowFormatDate() {
    //      var date = new Date();
    //      var seperator1 = "-";
    //      var year = date.getFullYear();
    //      var month = date.getMonth() + 1;
    //      var strDate = date.getDate();
    //      if (month >= 1 && month <= 9) {
    //        month = "0" + month;
    //      }
    //      if (strDate >= 0 && strDate <= 9) {
    //        strDate = "0" + strDate;
    //      }
    //      var currentdate = year + seperator1 + month + seperator1 + strDate
    //      return currentdate;
    //   }
    //   //时间选择结束
    //单文件上传
    $('#customFile').change(function (e) {
      $('.custom-file-label').html(e.target.files[0].name)
      $('#tosubmit').attr("disabled", true);
      var file = e.target.files[0];
      var formData = new FormData();
      formData.append("file", file);  //上传一个files对
      axios.post('{{ route('files.store') }}', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(res => {
        console.log(res, 3123123)
        $('#tosubmit').attr("disabled", false);
        $('#model-body-container').html('上传成功')
        $('#alertbot').modal('show')
        setTimeout("$('#alertbot').modal('hide')",1000);
        oneid = res.data.data.id;
      }).catch(err => {
        $('#model-body-container').html('上传失败，仅支持docx和txt格式，最大支持15M')
        $('#alertbot').modal('show')
        setTimeout("$('#alertbot').modal('hide')",2000);
        $('#tosubmit').attr("disabled", true);
      })
    })

    // $("form").submit(function(e){
    // <s></s>
    // });
    //文件上传提交论文
    $("#tosubmit").click(function () {
      if ($('#title').val() == '') return false;
      if ($('#writer').val() == '') return false;
      // 判断选择谁
      if ($('#contentfile').hasClass('active')) {
        if (oneid == '') return false;
        $('#tosubmit').css("display", "none");
        $('#submitBtn').css("display", "block")
        axios.post('{{route('orders.store')}}', {
            cid: $('#cid').val(),
            from: '维普PC端',
            file_id: oneid,
            type: 'file',
            content: '',
            title: $('#title').val(),
            writer: $('#writer').val(),
            endDate:$('#element_id').val()
          }
        ).then(res => {
          console.log(res, 3123123)
          var order = res.data.data
          location.href = '/orders/' + res.data.data.id
        }).catch(err => {
          console.log(err, 3112312312)
          alert('提交失败，请重试')
          $('#tosubmit').css("display", "block");
          $('#submitBtn').css("display", "none")
        })
      } else {
        $('#tosubmit').css("display", "none");
        $('#submitBtn').css("display", "block")
        axios.post('{{route('orders.store')}}', {
            cid: $('#cid').val(),
            from: '维普PC端',
            type: 'content',
            content: $('#content').val(),
            title: $('#title').val(),
            writer: $('#writer').val(),
            endDate:$('#element_id').val()
          }
        ).then(res => {
          console.log(res, 3123123)
          var order = res.data.data
          location.href = '/orders/' + res.data.data.id
        }).catch(err => {
          alert('提交失败，请重试')
          $('#tosubmit').css("display", "block");
          $('#submitBtn').css("display", "none")
        })
      }
    })

    })
  </script>
@stop
