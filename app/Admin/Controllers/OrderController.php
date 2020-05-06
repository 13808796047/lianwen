<?php

namespace App\Admin\Controllers;


use App\Models\Order;
use App\Models\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class OrderController extends AdminController
{
    protected function grid()
    {
        return Grid::make(Order::with(['category']), function(Grid $grid) {
            $grid->id->sortable();
            $grid->paginate(10);
            $grid->model()->orderBy('created_at', 'desc');
            $grid->column('orderid', '订单号')->display(function($orderid) {
                $order = Order::query()->where('orderid', $orderid)->first();
                return "<a href='orders/{$order->id}/download_report'>$orderid</a>";

            });
            $grid->column('category.name');
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
            $grid->column('writer', '作者');
            $grid->column('words', '字数');
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

//    /**
//     * Make a show builder.
//     *
//     * @param mixed $id
//     *
//     * @return Show
//     */
//    protected function detail($id)
//    {
//        return Show::make($id, new Order(), function(Show $show) {
//            $show->id;
//            $show->orderid;
//            $show->cid;
//            $show->userid;
//            $show->status;
//            $show->title;
//            $show->writer;
//            $show->content;
//            $show->date_publish;
//            $show->words;
//            $show->price;
//            $show->pay_price;
//            $show->pay_type;
//            $show->payid;
//            $show->date_pay;
//            $show->paper_path;
//            $show->report_path;
//            $show->rate;
//            $show->result;
//            $show->from;
//            $show->keyword;
//            $show->rid;
//            $show->del;
//            $show->api_orderid;
//            $show->report_pdf_path;
//            $show->endDate;
//            $show->publishdate;
//            $show->created_at;
//            $show->updated_at;
//        });
//    }
//
//    /**
//     * Make a form builder.
//     *
//     * @return Form
//     */
//    protected function form()
//    {
//        return Form::make(new Order(), function(Form $form) {
//            $form->display('id');
//            $form->text('orderid');
//            $form->text('cid');
//            $form->text('userid');
//            $form->text('status');
//            $form->text('title');
//            $form->text('writer');
//            $form->text('content');
//            $form->text('date_publish');
//            $form->text('words');
//            $form->text('price');
//            $form->text('pay_price');
//            $form->text('pay_type');
//            $form->text('payid');
//            $form->text('date_pay');
//            $form->text('paper_path');
//            $form->text('report_path');
//            $form->text('rate');
//            $form->text('result');
//            $form->text('from');
//            $form->text('keyword');
//            $form->text('rid');
//            $form->text('del');
//            $form->text('api_orderid');
//            $form->text('report_pdf_path');
//            $form->text('endDate');
//            $form->text('publishdate');
//
//            $form->display('created_at');
//            $form->display('updated_at');
//        });
//    }
}
