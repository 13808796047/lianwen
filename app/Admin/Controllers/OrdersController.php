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
    protected $title = 'App\Models\Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->column('id', __('Id'));
        $grid->column('orderid', __('Orderid'));
        $grid->column('cid', __('Cid'));
        $grid->column('userid', __('Userid'));
        $grid->column('status', __('Status'));
        $grid->column('title', __('Title'));
        $grid->column('writer', __('Writer'));
        $grid->column('content', __('Content'));
        $grid->column('date_publish', __('Date publish'));
        $grid->column('words', __('Words'));
        $grid->column('price', __('Price'));
        $grid->column('pay_price', __('Pay price'));
        $grid->column('pay_type', __('Pay type'));
        $grid->column('payid', __('Payid'));
        $grid->column('date_pay', __('Date pay'));
        $grid->column('paper_path', __('Paper path'));
        $grid->column('report_path', __('Report path'));
        $grid->column('rate', __('Rate'));
        $grid->column('result', __('Result'));
        $grid->column('from', __('From'));
        $grid->column('keyword', __('Keyword'));
        $grid->column('rid', __('Rid'));
        $grid->column('del', __('Del'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('api_orderid', __('Api orderid'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('orderid', __('Orderid'));
        $show->field('cid', __('Cid'));
        $show->field('userid', __('Userid'));
        $show->field('status', __('Status'));
        $show->field('title', __('Title'));
        $show->field('writer', __('Writer'));
        $show->field('content', __('Content'));
        $show->field('date_publish', __('Date publish'));
        $show->field('words', __('Words'));
        $show->field('price', __('Price'));
        $show->field('pay_price', __('Pay price'));
        $show->field('pay_type', __('Pay type'));
        $show->field('payid', __('Payid'));
        $show->field('date_pay', __('Date pay'));
        $show->field('paper_path', __('Paper path'));
        $show->field('report_path', __('Report path'));
        $show->field('rate', __('Rate'));
        $show->field('result', __('Result'));
        $show->field('from', __('From'));
        $show->field('keyword', __('Keyword'));
        $show->field('rid', __('Rid'));
        $show->field('del', __('Del'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('api_orderid', __('Api orderid'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order());

        $form->text('orderid', __('Orderid'));
        $form->number('cid', __('Cid'));
        $form->number('userid', __('Userid'));
        $form->switch('status', __('Status'));
        $form->text('title', __('Title'));
        $form->text('writer', __('Writer'));
        $form->textarea('content', __('Content'));
        $form->datetime('date_publish', __('Date publish'))->default(date('Y-m-d H:i:s'));
        $form->number('words', __('Words'));
        $form->decimal('price', __('Price'))->default(0.00);
        $form->decimal('pay_price', __('Pay price'))->default(0.00);
        $form->text('pay_type', __('Pay type'));
        $form->text('payid', __('Payid'));
        $form->datetime('date_pay', __('Date pay'))->default(date('Y-m-d H:i:s'));
        $form->text('paper_path', __('Paper path'));
        $form->text('report_path', __('Report path'));
        $form->decimal('rate', __('Rate'))->default(0.00);
        $form->textarea('result', __('Result'));
        $form->text('from', __('From'));
        $form->text('keyword', __('Keyword'));
        $form->number('rid', __('Rid'));
        $form->text('del', __('Del'));
        $form->text('api_orderid', __('Api orderid'));

        return $form;
    }
}
