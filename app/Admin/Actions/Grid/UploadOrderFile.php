<?php

namespace App\Admin\Actions\Grid;

use App\Admin\Forms\UploadOrderFile as UploadOrderFileForm;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UploadOrderFile extends RowAction
{

    protected $title = '上传文件';


    public function render()
    {
        $id = "upload-order-file-{$this->getKey()}";

        // 模态窗
        $this->modal($id);
        return <<<HTML
<span class="grid-expand" data-toggle="modal" data-target="#{$id}">
   <a href="javascript:void(0)">上传zip</a>
</span>
HTML;
    }

    protected function modal($id)
    {
        // 工具表单
        $form = new UploadOrderFileForm($this->getKey());

        // 在弹窗标题处显示当前行的用户名
        $orderid = $this->row->orderid;

        // 刷新页面时移除模态窗遮罩层
        Admin::script('Dcat.onPjaxComplete(function () {
            $(".modal-backdrop").remove();
        }, true)');

        // 通过 Admin::html 方法设置模态窗HTML
        Admin::html(
            <<<HTML
<div class="modal fade" id="{$id}">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">订单 - {$orderid}</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        {$form->render()}
      </div>
    </div>
  </div>
</div>
HTML
        );
    }
}
