<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;


class Category2Controller extends Controller
{
    public function index()
    {
        $categories = Category::paginate(2);

        return CategoryResource::collection($categories);
    }
}
