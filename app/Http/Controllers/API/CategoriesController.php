<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function getCategories()
    {
        $categories = Categories::all();
        return response()->json([
            'data'=> $categories
        ],200);

    }
}
