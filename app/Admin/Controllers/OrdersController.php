<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrdersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '订单';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->column('orderid', '订单号');
        $grid->column('category.name', '分类');
        // 展示关联关系的字段时，使用 column 方法
        $grid->column('user.name', '买家');
        $grid->column('price', '金额');
        $grid->column('title', '标题');
        $grid->column('writer', '作者');
        $grid->column('date_publish', '发表时间');
        $grid->column('words', '字数');
        $grid->column('pay_price', '支付金额');
        $grid->column('pay_type', '支付方式');
        $grid->column('payid', '支付ID');
        $grid->column('date_pay', '支付日期');
        $grid->column('rate', '完成率');
        $grid->column('result', '结果');
        $grid->column('from', '来源');
        $grid->column('created_at', '创建时间');
        $grid->column('api_orderid', 'api订单ID');
        // 禁用创建按钮，后台不需要创建订单
        $grid->disableCreateButton();
        $grid->actions(function($actions) {
            // 禁用删除和编辑按钮
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->tools(function($tools) {
            // 禁用批量删除按钮
            $tools->batch(function($batch) {
                $batch->disableDelete();
            });
        });
        return $grid;
    }
}
