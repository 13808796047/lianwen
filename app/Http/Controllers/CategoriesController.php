<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {

    }

    public function show($classid)
    {
        $category = Category::where('classid', $classid)->get();
        dd($category);
        return view();
    }
}
