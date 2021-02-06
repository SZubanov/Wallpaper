<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResourceCollection;
use App\Http\Resources\Categories\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $models = Category::with('media')
            ->withCount('wallpapers')
            ->pagePaginate();
        return new BaseResourceCollection($models, CategoryResource::class);

    }


    public function show(Category $category)
    {
        return new CategoryResource($category->load('media')->loadCount('wallpapers'));
    }
}
