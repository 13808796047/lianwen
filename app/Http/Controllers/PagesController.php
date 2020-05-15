<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class PagesController extends Controller
{
    public function index()
    {
        dd(URL::previous());
        return view('domained::pages.index');
    }
}
