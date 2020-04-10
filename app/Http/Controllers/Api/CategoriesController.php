<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::query()->where('status', 1)->get();
        return CategoryResource::collection($categories)->collection->groupBy('classid');
    }
}
