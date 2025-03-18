<?php

namespace Inovector\ProductManager\Http\Controllers;

use Inovector\ProductManager\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }
}
