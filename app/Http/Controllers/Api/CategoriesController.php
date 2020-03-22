<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories)->collection->groupBy('classid');
    }

    public function show($classid)
    {

    }
}
