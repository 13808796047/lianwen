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

    public function store(AutoCheckRequest $request, AutoCheck $autoCheck)
    {
        $content = $request->input('content');
        $data = new AutoCheck([
            'content_before' => $content,
            'user_id' => $request->user()->id,
        ]);
        return response()->json([
            'data' => $data
        ]);
    }
}
