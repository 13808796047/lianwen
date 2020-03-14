<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoriesController extends AdminController
{

    protected $title = '分类列表';


    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->id('ID');
        $grid->name('名称');
        $grid->price_type('计价模式')->display(function($value) {
            return Category::$priceTypeMap[$value];
        });
        $grid->price('单价');
        $grid->agent_price1('代理商单价');
        $grid->agent_price2('高级代理单价');
        $grid->check_type('检测模式')->display(function($value) {
            return Category::$checkTypeMap[$value];
        });
        $grid->staus('状态')->bool(['Y' => 1, 'N' => 0]);
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
        $form->number('aid', 'app_id');
        $form->number('classid', '分类ID');
        $form->text('classname', '分类名称')->rules('required');
        $form->text('name', '系统名称')->rules('required');
        $form->text('sname', '系统简称')->rules('required');
        $priceTypeOption = [
            0 => '千字/元',
            1 => '万字/元',
            2 => '篇'
        ];
        $form->select('price_type', '计价方式')->options($priceTypeOption);
        $form->decimal('price', '检测单价')->default(0.00);
        $form->decimal('agent_price1', '普通代理价')->default(0.00);
        $form->decimal('agent_price2', '高级代理价')->default(0.00);
        $checkTypeOption = [
            0 => '手动',
            1 => 'API'
        ];
        $form->select('price_type', '计价方式')->options($checkTypeOption);

        $form->number('min_words', '最少字数');
        $form->number('max_words', '最多字数');
        $form->quill('intro', '系统介绍');
        $form->textarea('sintro', '系统简介');

        $form->text('tese', '特色');
        $form->text('seo_title', 'SEO标题');
        $form->image('sys_logo', '系统LOGO');
        $form->image('sys_ico', '系统图标');

        $form->switch('status', '状态');


        return $form;
    }
}
