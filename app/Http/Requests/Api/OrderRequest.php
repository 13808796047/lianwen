<?php

namespace App\Http\Requests\Api;


class OrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'writer' => 'required',
            'content' => 'required_without:file',
            'file_id' => 'required_without:content'
        ];
    }

    public function attributes()
    {
        return [
            'title' => '标题',
            'writer' => '作者',
            'file' => '论文文件',
            'content' => '粘贴内容'
        ];
    }
}
