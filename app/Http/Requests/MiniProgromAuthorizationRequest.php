<?php

namespace App\Http\Requests;


class MiniProgromAuthorizationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required|string',
        ];
    }
}
