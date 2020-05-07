<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;
use Symfony\Component\HttpFoundation\Response;

class ResetOrderStatus extends Form
{
    // 增加一个自定义属性保存用户ID
    protected $id;

    // 构造方法的参数必须设置默认值
    public function __construct($id = null)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function handle(array $input)
    {
        // dump($input);

        // return $this->error('Your error message.');

        return $this->success('Processed successfully.');
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('name')->required();
        $this->email('email')->rules('email');
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        return [
            'name' => 'John Doe',
            'email' => 'John.Doe@gmail.com',
        ];
    }
}
