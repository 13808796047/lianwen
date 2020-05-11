<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
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
        $user = $request->user();
        if($user->jc_times <= 0) {
            throw new InvalidRequestException('您的降重次数不足!');
        }
        $data = AutoCheck::create([
            'content_before' => $request->input('content'),
            'user_id' => $user->id,
        ]);
        $user->decreaseJcTimes();
        return response(compact('data'), 200);
    }

    public function show(AutoCheck $autoCheck)
    {
        return response(compact('autoCheck'), 200);
    }
}
