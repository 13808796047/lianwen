@extends('layouts.app')
@section('title', '创建订单')
@section('styles')
  <link rel="stylesheet" href="{{asset('asset/css/reset.css')}}">
@stop
@section('content')
  <div class="main clearfix">
    <div class="lbox fl">
      <ul class="versionlist clearfix v2">
        <li class="tab i-select">
          <div class="version">
            <b>联文检测(高级版)</b> <br/>
            <span class="price">（3.00/万字）</span>
          </div>
          首篇一万字内免费..
        </li>
        <li class="tab">
          <div class="version">
            <b>联文检测(旗舰版)</b> <br/>
            <span class="price">（1.50/千字）</span>
          </div>
          检测范围更广更严格，适合定..
        </li>
        <li class="tab">
          <div class="version">
            <b>PaperPass旗舰版</b> <br/>
            <span class="price">（1.80/千字）</span>
          </div>
          仅支持中文论文检测..
        </li>
      </ul>
      <div>
        <form
          action="https://www.lianwen.com/check/index/12"
          enctype="multipart/form-data"
          method="post"
          accept-charset="utf-8"
          onsubmit="return app.tijiao()"
        >
          <div class="tips">
            支持中文论文检测，适合初检，每账户享免费检测一次，限一万字符以内，超过按3元/万字收费。
          </div>
          <!---->
          <div class="tips" style="color: rgb(255, 0, 0);">
            <b
            >郑重承诺：本站所有报告均出自正版系统，支持官网验证，假一赔十，投诉热线：400-823-8869</b
            >
          </div>
          <div id="emsg" style="color: red;">
            <p id="nofile" class="text-error"></p>
            <p id="cout" class="text-error"></p>
          </div>
          <div class="clearfix">
            <input type="hidden" name="uid" value="21915"/>
            <input type="hidden" name="id" value="19"/>
            <input type="hidden" name="cfrom" value="main"/>
            <dl class="item">
              <dt>题目：</dt>
              <dd>
                <input
                  type="text"
                  placeholder="请输入论文题目"
                  name="title"
                  id="title"
                  class="txt"
                />
              </dd>
            </dl>
            <dl class="item">
              <dt>作者：</dt>
              <dd>
                <input
                  type="text"
                  placeholder="请输入论文作者"
                  id="author"
                  name="writer"
                  class="txt"
                />
              </dd>
            </dl>
            <!---->
            <dl style="display: none;">
              <input
                type="hidden"
                name="phone"
                value=""
                id="phone"
                class="txt"
              />
            </dl>
            <dl class="item">
              <dt>方式：</dt>
              <dd style="padding-top: 5px;">
                    <span
                      onselectstart="return&amp;nbsp;false;"
                      style="cursor: pointer; display: inline-block;"
                    ><input
                        type="radio"
                        checked="checked"
                        name="mode"
                        value="0"
                        id="text"
                      />
                      <span>粘贴文本</span></span
                    >
                <span
                  onselectstart="return&amp;nbsp;false;"
                  style="cursor: pointer;"
                ><input type="radio" name="mode" value="1" id="file"/>
                      文件上传</span
                >
              </dd>
            </dl>
            <dl id="text_box" class="item" style="display: block;">
              <dt>论文：</dt>
              <dd>
                    <textarea
                      cols="10"
                      name="content"
                      value=""
                      class="txts"
                      style="word-break: break-all; resize: none;"
                    ></textarea
                    ><br/>
                当前共输入<b id="num" class="error">0</b
                >字数，字数不小于<span>1000</span>字
              </dd>
            </dl>
            <dl id="upload" class="item" style="display: none;">
              <dt></dt>
              <dd>
                <div>
                  <input
                    type="hidden"
                    name="textfield"
                    id="textfield"
                    class="content"
                  />
                  <label class="upload"
                  ><span
                      style="width: 100%; height: 100%; padding: 7px 10px;"
                    >选择文件</span
                    >
                    <input
                      type="file"
                      name="file"
                      id="file"
                      value=""
                      onchange="document.getElementById(&#39;textfield&#39;).value=this.value; document.getElementById(&#39;checktext&#39;).innerText=this.value"
                      class="replyFileid"
                    /></label>
                  <span id="checktext" style="margin-left: 13px;"
                  >未选择文件</span
                  >
                  <br/>
                  "请上传要检测的论文"
                  <span class="error">支持：doc，docx</span>
                  "格式"
                </div>
              </dd>
            </dl>
            <div class="item">
              <input type="submit" value="提交检测" class="btn"/>
            </div>
            <input type="hidden" name="cfrom" value="user"/>
            <input type="hidden" name="from_uid" value="0"/>
          </div>
        </form>
      </div>
    </div>
    <div>
      <div class="rbox fr">
        <div class="tit">版本选择帮助</div>
        <div class="box">
          <table width="306" border="1" cellspacing="0" cellpadding="0">
            <tbody>
            <tr>
              <th align="left">系统名称</th>
              <th align="left">价格</th>
              <th scope="col">语言支持</th>
              <th scope="col">检测结果</th>
            </tr>
            <tr>
              <td>联文普通版</td>
              <td>3元/万字</td>
              <td align="center">中文/英文</td>
              <td align="center">一般</td>
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
            <tr>
              <td colspan="4" style="border-top:#999 dotted 1px;">
                推荐使用“联文专业版”，性价比最高，检测结果准确。
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        <div class="box mt10">
          <b>1、怎么选择适合自己的论文检测系统？</b>
          <p>
            只有使用和学校相同的数据库，才能保证重复率与学校、杂志社100%一致：<br/>论文初次修改可使用联文检测、PaperPass，定稿再使用与学校一样的系统。
          </p>
          <b>2、检测要多长时间，报告怎么还没出来？</b>
          <p>
            正常检测20分钟左右，毕业高峰期，服务器检测压力大，时间会有延长，请大家提前做好时间准备。超过2小时没出结果可以联系客服处理！
          </p>
          <b>3、同一篇论文可以多次检测吗？？</b>
          <p>本站不限制论文检测次数，但检测一次需支付一次费用。</p>
          <b>4、检测报告有网页版、pdf格式的吗？</b>
          <p>
            检测完成后会提供网页版和pdf格式的检测报告，报告只是格式不同，重复率都一样的。
          </p>
        </div>
      </div>
    </div>
  </div>
@stop
@section('scripts')
  <script>
    $(() => {
      $('.versionlist .tab').click(() => {
        $(this).addClass('i-select').siblings().removeClass('i-select');
      });
    })
  </script>
@stop

