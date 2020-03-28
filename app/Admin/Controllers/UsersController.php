<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UsersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());
        $grid->id('ID');
        $grid->phone('手机号');
        $grid->nick_name('微信昵称');
//        $grid->email_verified_at('已验证邮箱')->display(function($value) {
//            return $value ? '是' : '否';
//        });
        $grid->column('user_group', '用户组')
            ->using([
                0 => '普通用户',
                1 => '普通代理 ',
                2 => '高级代理 ',
            ])->label([
                0 => 'default',
                1 => 'info',
                2 => 'success',
            ]);
        $grid->consumption_amount('消费金额');
        $grid->created_at('注册时间');
        // 不在页面显示 `新建` 按钮，因为我们不需要在后台新建用户
        $grid->disableCreateButton();
        // 同时在每一行也不显示 `编辑` 按钮
        $grid->disableActions();
        $grid->tools(function($tools) {
            // 禁用批量删除按钮
            $tools->batch(function($batch) {
                $batch->disableDelete();
            });
        });
        return $grid;
    }
}
