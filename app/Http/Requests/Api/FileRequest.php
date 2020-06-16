<?php

namespace App\Http\Requests\Api;


class FileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'file' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'file' => '论文文件'
        ];
    }
}
