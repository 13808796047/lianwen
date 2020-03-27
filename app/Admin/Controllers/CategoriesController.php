<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoriesController extends AdminController
{

    protected $title = '检测分类';


    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->id('ID');
        $grid->name('名称');
        $grid->price_type('计价模式')->display(function($value) {
            return Category::$priceTypeMap[$value] . '/元';
        });
        $grid->price('单价(元)');
        $grid->agent_price1('代理商单价');
        $grid->agent_price2('高级代理单价');
        $grid->check_type('检测模式')->display(function($value) {
            return Category::$checkTypeMap[$value];
        });
        $grid->staus('状态')->bool(['Y' => 1, 'N' => 0]);
        $grid->actions(function($actions) {
            $actions->disableView();
        });
        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category());

// 第一列占据1/2的页面宽度
        $form->column(1 / 2, function($form) {
            $form->number('cid', 'cid');
            $form->number('classid', '分类ID');
            $form->text('classname', '分类名称')->rules('required');
            $form->text('name', '系统名称')->rules('required');
            $form->text('sname', '系统简称')->rules('required');
            $form->radio('price_type', '计价方式')->options([
                0 => '千字/元',
                1 => '万字/元',
                2 => '篇']);
            $form->decimal('price', '检测单价')->default(0.00);
            $form->decimal('agent_price1', '普通代理价')->default(0.00);
            $form->decimal('agent_price2', '高级代理价')->default(0.00);
            $checkTypeOption = [
                0 => '手动',
                1 => 'API'
            ];
            $form->radio('check_type', '检测方式')->options($checkTypeOption)->default(0);

            $form->number('min_words', '最少字数');
            $form->number('max_words', '最多字数');
            $form->image('sys_logo', '系统LOGO');
        });
        $form->column(1 / 2, function($form) {

            $form->quill('intro', '系统介绍');
            $form->textarea('sintro', '系统简介');

            $form->text('tese', '特色');
            $form->text('seo_title', 'SEO标题');

            $form->image('sys_ico', '系统图标');

            $form->switch('status', '状态');
        });
        $form->tools(function(Form\Tools $tools) {

            // 去掉`列表`按钮
            $tools->disableList();

        
            // 去掉`查看`按钮
            $tools->disableView();
        });

        return $form;
    }
}
