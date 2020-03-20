<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class PagesController extends Controller
{
    public function index()
    {
        return view('pages.index', compact('categories'));
    }
}
