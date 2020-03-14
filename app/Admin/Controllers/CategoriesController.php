<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoriesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '分类列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->id('ID');
        $grid->name('名称');
        $grid->price_type('计价模式')->display(function($value) {
            return Category::$priceTypeMap[$value];
        });
        $grid->price('单价');
        $grid->price_agent1('代理商单价');
        $grid->price_agent2('高级代理单价');
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

        $form->number('aid', __('Aid'));
        $form->number('classid', __('Classid'));
        $form->text('classname', __('Classname'));
        $form->switch('status', __('Status'));
        $form->text('name', __('Name'));
        $form->text('sname', __('Sname'));
        $form->switch('price_type', __('Price type'));
        $form->decimal('price', __('Price'))->default(0.00);
        $form->decimal('agent_price1', __('Agent price1'))->default(0.00);
        $form->decimal('agent_price2', __('Agent price2'))->default(0.00);
        $form->switch('check_type', __('Check type'));
        $form->number('min_words', __('Min words'));
        $form->number('max_words', __('Max words'));
        $form->textarea('intro', __('Intro'));
        $form->textarea('sintro', __('Sintro'));
        $form->text('tese', __('Tese'));
        $form->text('seo_title', __('Seo title'));
        $form->text('sys_logo', __('Sys logo'));
        $form->text('sys_ico', __('Sys ico'));

        return $form;
    }
}
