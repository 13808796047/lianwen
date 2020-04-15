<?php

namespace App\Http\Controllers;

use App\Handlers\AutoCheckHandler;
use App\Http\Requests\AutoCheckRequest;
use Illuminate\Http\Request;

class AutoCheckController extends Controller
{
    public function index()
    {
        return view('auto_check.index');
    }

    public function store(AutoCheckRequest $request, AutoCheckHandler $autoCheckHandler)
    {
        $content = $request->input('content');
        $result_en = $autoCheckHandler->translate_en($content);
        sleep(1000);
        $result_zh = $autoCheckHandler->translate_cn($result_en);
        return response()->json([
            'data' => $result_zh,
        ]);
    }
}
