<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class PagesController extends Controller
{
    public function index()
    {
        //以下为测试
        //在搜索引擎搜索个关键词，进入网站
        $word = search_word_from(URL::previous());
        if(!empty($word['keyword'])) {
            dd('关键字：' . $word['keyword'] . ' 来自：' . $word['from']);
        }
        return view('domained::pages.index');
    }
}
