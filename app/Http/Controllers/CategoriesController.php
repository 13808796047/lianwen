<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {

    }

    public function show($classid)
    {
        $category = Category::where('classid', $classid)->get();
        return view('orders.create', compact('category'));
    }
}
