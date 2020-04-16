@extends('domained::layouts.app')
@section('title','查看报告')
@section('styles')
  <link rel="stylesheet" href="{{asset('asset/css/check.css')}}">

  <style>
    .card-body p {
      text-indent: 2em !important;
    }

  </style>

@stop
@section('content')
  <div class="container-fluid mt-5 mb-24">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h2 class="text-3xl text-center">{{ $order->title }}</h2>
              <div class="info">
                <span>作者:</span>
                &emsp;
                <span>{{ $order->writer }}</span>
                &emsp;
                <span>提交时间:</span>
                &emsp;
                <span>{{ $order->created_at }}</span>
                &emsp;
                <span>重复率:</span>
                &emsp;
                <span>{{ $order->rate }}</span>
                &emsp;
                <a href="{{ route('orders.download',['orderid'=>$order->orderid]) }}"
                   class="bg-blue-500 px-2 rounded-sm text-white">下载报告</a>
              </div>
            </div>
            @if($order->report->content)
              {!! $order->report->content !!}
            @else
              <!-- <h2 class="text-center text-5xl">暂无内容!!!!</h2> -->
              <iframe src="https://wap.lianwen.com/dev/weipu.pdf" width="100%" height="500"></iframe>
            @endif
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="bg-white p-5">
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
  </div>
@stop
@section('scripts')
  <script !src="">
    $(function () {
      $('.navbar>div').removeClass('container').addClass('container-fluid')
    })
  </script>
@stop

