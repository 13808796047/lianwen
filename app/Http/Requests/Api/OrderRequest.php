<?php

namespace App\Http\Requests\Api;


class OrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'writer' => 'required',
            'content' => 'required|min:1000'
        ];
    }

    public function attributes()
    {
        return [
            'title' => '标题',
            'writer' => '作者',
            'content' => '内容'
        ];
    }
}
