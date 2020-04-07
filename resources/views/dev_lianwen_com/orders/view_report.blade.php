@extends('domained::layouts.app')
@section('title','查看报告')
@section('styles')
  <link rel="stylesheet" href="{{asset('asset/css/check.css')}}">
@stop
@section('content')
  <div class="main clearfix">
    <div class="lbox fl">
      <h1>{{ $order->title }}</h1>
      <div class="info">作者：{{ $order->writer }}&emsp;提交时间：{{ $order->created_at }}&emsp;重复率：{{ $order->rate }}&emsp;<a
          href="{{ route('orders.download',$order) }}"
          target="_blank"
          class="bbtn">下载完整报告</a>&emsp;<a
          href="#" target="_blank" class="rbtn">在线改重</a></div>
      @include('orders._report',$order)
    </div>
  </div>
@stop
