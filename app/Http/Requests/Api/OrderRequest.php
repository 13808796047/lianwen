<?php

namespace App\Http\Requests\Api;


class OrderRequest extends FormRequest
{
//application/vnd.openxmlformats-officedocument.wordprocessingml.document
//application/vnd.openxmlformats-officedocument.wordprocessingml.document
    // application/vnd.openxmlformats-officedocument.wordprocessingml.document
    public function rules()
    {
        return [
            'title' => 'required',
            'writer' => 'required',
            'content' => 'required_without:file',
            'file' => 'required_without:content|mimes:txt,docx,zip'
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
