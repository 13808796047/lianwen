<?php

namespace App\Http\Controllers;

use App\Handlers\AutoCheckHandler;
use App\Http\Requests\AutoCheckRequest;
use App\Models\AutoCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AutoCheckController extends Controller
{
    public function index()
    {
        return view('domained::auto_checks.index');
    }

    public function store(AutoCheckRequest $request)
    {
        $result = app(AutoCheckHandler::class)->translate_en($request->input('content'));
        dd($result);
        $enContent = '';
        foreach($result['trans_result'] as $value) {
            $enContent .= $value['dst'];
        }
        dd(app(AutoCheckHandler::class)->translate_cn($enContent));
        $data = AutoCheck::create([
            'content_before' => $request->input('content'),
            'user_id' => $request->user()->id,
        ]);
        return response(compact('data'), 200);
    }

    public function show(AutoCheck $autoCheck)
    {
        return response(compact('autoCheck'), 200);
    }
}
