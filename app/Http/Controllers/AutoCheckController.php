<?php

namespace App\Http\Controllers;

use App\Handlers\AutoCheckHandler;
use App\Http\Requests\AutoCheckRequest;
use App\Models\AutoCheck;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AutoCheckController extends Controller
{
    public function index()
    {
        return view('domained::auto_checks.index');
    }

    public function store(AutoCheckRequest $request)
    {
        $data = AutoCheck::create([
            'content_before' => $request->input('content'),
            'user_id' => $request->user()->id,
        ]);
        if(Auth::user()->decreaseJcTimes() <= 0) {
            throw new InvalidArgumentException('您的降重次数不足!');
        }
        return response(compact('data'), 200);
    }

    public function show(AutoCheck $autoCheck)
    {
        return response(compact('autoCheck'), 200);
    }
}
