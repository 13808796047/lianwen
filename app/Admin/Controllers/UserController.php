<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class UserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->username;
            $grid->phone;
            $grid->email;
            $grid->email_verified_at;
            $grid->password;
            $grid->weixin_openid;
            $grid->weapp_openid;
            $grid->weixin_session_key;
            $grid->weixin_unionid;
            $grid->remember_token;
            $grid->nick_name;
            $grid->avatar;
            $grid->user_group;
            $grid->consumption_amount;
            $grid->redix;
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
        return Show::make($id, new User(), function (Show $show) {
            $show->id;
            $show->username;
            $show->phone;
            $show->email;
            $show->email_verified_at;
            $show->password;
            $show->weixin_openid;
            $show->weapp_openid;
            $show->weixin_session_key;
            $show->weixin_unionid;
            $show->remember_token;
            $show->nick_name;
            $show->avatar;
            $show->user_group;
            $show->consumption_amount;
            $show->redix;
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
        return Form::make(new User(), function (Form $form) {
            $form->display('id');
            $form->text('username');
            $form->text('phone');
            $form->text('email');
            $form->text('email_verified_at');
            $form->text('password');
            $form->text('weixin_openid');
            $form->text('weapp_openid');
            $form->text('weixin_session_key');
            $form->text('weixin_unionid');
            $form->text('remember_token');
            $form->text('nick_name');
            $form->text('avatar');
            $form->text('user_group');
            $form->text('consumption_amount');
            $form->text('redix');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
