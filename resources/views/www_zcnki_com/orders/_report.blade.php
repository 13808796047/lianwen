@extends('domained::layouts.app')
@section('title', '首页')
@section('styles')
@stop
@section('content')
  <div class="container mt-5 mb-24">

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
            <a href="{{ route('orders.download',$order) }}" class="bg-blue-500 px-2 rounded-sm text-white">下载报告</a>
          </div>
        </div>
        {!! $order->report->content !!}
      </div>
    </div>
  </div>
@stop
