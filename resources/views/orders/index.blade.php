@extends('layouts.app')
@section('title', '检测报告')
@section('styles')
  <link rel="stylesheet" href="{{asset('asset/css/check.css')}}">
@stop
@section('content')
  <div class="main clearfix">
    <div class="lbox fl">


      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="orderlist">
        <tbody>
        <tr>
          <th scope="col" width="30" align="center"><input type="checkbox" id="allcheck">
          </th>

          <th scope="col">论文题目</th>
          <th scope="col" width="130">系统名称</th>
          <th scope="col" width="75">状态</th>
          <th scope="col" width="70">检测结果</th>
          <th scope="col" width="168">提交日期</th>
          <th scope="col" width="100">操作</th>
        </tr>
        @foreach($orders as $order)
          <tr>
            <td align="center"><input type='checkbox' name='delete' value='4026'/></td>
            <td>{{$order->title}}</td>
            <td align="center">{{$order->category->name}}</td>
            <td align="center">{{\App\Models\Enum\OrderEnum::getStatusName($order->status)}}</td>
            <td align="center">-</td>
            <td align="center">{{$order->created_at}}</td>
            @if($order->status==0)
              <td align="center"><a href='{{route('orders.show',$order)}}' class="bbtn"/>支付</a></td>
            @endif
            @if($order->status==4)
              <td align="center"><a href='{{route('orders.show',$order)}}' class="bbtn"/>查看报告</a></td>
            @endif
          </tr>
        @endforeach

        <tr>
          <td colspan="2" align="left">&ensp;<a class="rbtn" id="del_item">删除</a></td>
          <td colspan="5" align="right">
            共{{$orders->lastPage()}}页
            <span>共{{$orders->total()}}条</span>
            <span><a href="{{$orders->previousPageUrl()	}}">上一页</a></span>
            <span>
              @for($i=1;$i<=$orders->lastPage();$i++)
                @if($i==$orders->currentPage())
                  <span>&nbsp;</span><a style="color: red;" href='{{$orders->url($i)}}'>{{$i}}</a><span>&nbsp;</span>
                  <span>&nbsp;</span>
                @else
                  <span>&nbsp;</span><a href='{{$orders->url($i)}}'>{{$i}}</a><span>&nbsp;</span><span>&nbsp;</span>
                @endif
              @endfor
            </span>
            <span><a href="{{$orders->nextPageUrl()}}">下一页</a></span>
          </td>
        </tr>

        </tbody>
      </table>
    </div>

    <div class="rbox fr">
      <div class="tit">在线客服</div>
      <div class="box">客服微信:cx5078</div>
      <div class="box mt10">
        <b>1、怎么选择适合自己的论文检测系统？</b>
        <p>只有使用和学校相同的数据库，才能保证重复率与学校、杂志社100%一致：</br>论文初次修改可使用联文检测、PaperPass，定稿再使用与学校一样的系统。</p>
        <b>2、检测要多长时间，报告怎么还没出来？</b>
        <p>正常检测20分钟左右，毕业高峰期，服务器检测压力大，时间会有延长，请大家提前做好时间准备。超过2小时没出结果可以联系客服处理！</p>
        <b>3、同一篇论文可以多次检测吗？？</b>
        <p>本站不限制论文检测次数，但检测一次需支付一次费用。</p>
        <b>4、检测报告有网页版、pdf格式的吗？</b>
        <p>检测完成后会提供网页版和pdf格式的检测报告，报告只是格式不同，重复率都一样的。</p>

      </div>
    </div>

  </div>
@stop
