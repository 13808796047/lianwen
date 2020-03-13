<?php

namespace App\Http\Requests\Api;


class OrderRequest extends FormRequest
{


    public function rules()
    {
        return [
            'title' => 'required',
            'writer' => 'required',
            'content' => 'required_without:file|min:1000',
            'file' => 'required_without:content|mimes:txt,doc,docx'
        ];
    }

    public function attributes()
    {
        return [
            'title' => '标题',
            'writer' => '作者',
            'content' => '内容',
            'file' => '文件'
        ];
    }
}
