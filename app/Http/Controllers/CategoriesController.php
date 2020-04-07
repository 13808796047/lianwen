<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoriesController extends Controller
{
    public function show($classid)
    {
        $category = Category::where('classid', $classid)->get();
        return view('domained::orders.create', compact('category'));
    }
}
