<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\JcSetting;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class JcSettingController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new JcSetting(), function(Grid $grid) {
            $grid->id->sortable();
            $grid->type('类型')->using([0 => 'AI', 1 => '百度']);
            $grid->created_at;
            $grid->updated_at->sortable();

            $grid->filter(function(Grid\Filter $filter) {
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
        return Show::make($id, new JcSetting(), function(Show $show) {
            $show->id;
            $show->type;
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
        return Form::make(new JcSetting(), function(Form $form) {
            $form->hidden('id');
            $form->radio('type', '检测方式')->options([0 => 'AI', 1 => '百度'])->default(0);

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
