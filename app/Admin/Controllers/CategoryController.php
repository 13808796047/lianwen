<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Category;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class CategoryController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Category(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->cid;
            $grid->classid;
            $grid->classname;
            $grid->status;
            $grid->name;
            $grid->sname;
            $grid->price_type;
            $grid->price;
            $grid->agent_price1;
            $grid->agent_price2;
            $grid->check_type;
            $grid->min_words;
            $grid->max_words;
            $grid->intro;
            $grid->sintro;
            $grid->tese;
            $grid->seo_title;
            $grid->sys_logo;
            $grid->sys_ico;
            $grid->created_at;
            $grid->updated_at->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Category(), function (Show $show) {
            $show->id;
            $show->cid;
            $show->classid;
            $show->classname;
            $show->status;
            $show->name;
            $show->sname;
            $show->price_type;
            $show->price;
            $show->agent_price1;
            $show->agent_price2;
            $show->check_type;
            $show->min_words;
            $show->max_words;
            $show->intro;
            $show->sintro;
            $show->tese;
            $show->seo_title;
            $show->sys_logo;
            $show->sys_ico;
            $show->created_at;
            $show->updated_at;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Category(), function (Form $form) {
            $form->display('id');
            $form->text('cid');
            $form->text('classid');
            $form->text('classname');
            $form->text('status');
            $form->text('name');
            $form->text('sname');
            $form->text('price_type');
            $form->text('price');
            $form->text('agent_price1');
            $form->text('agent_price2');
            $form->text('check_type');
            $form->text('min_words');
            $form->text('max_words');
            $form->text('intro');
            $form->text('sintro');
            $form->text('tese');
            $form->text('seo_title');
            $form->text('sys_logo');
            $form->text('sys_ico');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
