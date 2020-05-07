<?php

namespace App\Admin\Controllers;


use App\Models\Order;
use App\Models\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class OrderController extends AdminController
{
    protected function grid()
    {
        // 第二个参数为 `Column` 对象， 第三个参数是自定义参数

        return Grid::make(Order::with(['category']), function(Grid $grid) {
            $grid->id->sortable();
            $grid->paginate(10);
            $grid->model()->orderBy('created_at', 'desc');
            $grid->column('orderid', '订单号')->display(function($orderid) {
                $order = Order::query()->where('orderid', $orderid)->first();
                return "<a href='orders/{$order->id}/download_report'>$orderid</a>";

            });
            $grid->column('category.name', '系统');
            // 展示关联关系的字段时，使用 column 方法
            $grid->column('userid', '买家')->display(function($userid) {
                return User::find($userid)->phone ?? '';
            });
            $grid->column('status', '状态')->using([
                0 => '未支付',
                1 => '待检测',
                2 => '排队中',
                3 => '检测中',
                4 => '检测完成'
            ])->dot([
                0 => 'danger',
                1 => 'info',
                2 => 'primary',
                3 => 'warning',
                4 => 'success',
            ]);
            $grid->column('title', '标题')->copyable()->width('220px');
            $grid->column('writer', '作者')->width('120px');
            $grid->column('words', '字数');
            $grid->column('pay_price', '支付金额');
//            $grid->column('pay_price', '支付金额')->totalRow(function($amount) {
//
//                return "<span class='text-danger text-bold'><i class='fa fa-yen'></i> {$amount} 元</span>";
//
//            });
            $grid->column('pay_type', '支付方式');
            $grid->column('from', '来源');
            $grid->column('created_at', '创建时间')->sortable();
//            $grid->batchActions(function($batch) {
//                $batch->add(new BatchQueue());
//            });
            // 禁用创建按钮，后台不需要创建订单
            $grid->disableCreateButton();
            // 禁用删除按钮
            $grid->disableDeleteButton();
            // 禁用详情按钮
            $grid->disableViewButton();
            $grid->filter(function(Grid\Filter $filter) {
                // 去掉默认的id过滤器
                $filter->disableIdFilter();
                // 在这里添加字段过滤器
                $filter->like('title', '标题');
                $filter->like('writer', '作者');
                $filter->like('orderid', '订单号');
                $filter->like('api_orderid', 'api订单ID');
                $filter->like('from', '来源');
                $filter->like('user.phone', '手机号');
                $filter->like('category.name', '检测系统');
                $filter->scope('1', '已支付')->where('status', 1);
                $filter->scope('3', '检测中')->where('status', 3);
                $filter->scope('4', '检测完成')->where('status', 4);
                $filter->scope('0', '未支付')->where('status', 0);
            });
        });
    }
}
