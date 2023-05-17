<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Categories;
use App\Models\User;

class ProductsController extends Controller
{
    public function topDeals()
    {
        $products = Products::all()->random(6);
        foreach ($products as $product) {
            $product['image_url'] = str_replace('"', '', $product['image_url']);
        }
        return response()->json([
            'data' => $products
        ], 200);
    }

    public function getCategoryBasedProducts($category)
    {
        $searchString = (explode('=', $category))[1];
        $category = Categories::where('name', '=', $searchString)->first();
        return response()->json([
            'data' => [
                'data' => $category->products->lazy()->toArray(),
                'category' => $category->name,
            ]
        ], 200);

    }

    public function searchProducts(Request $request)
    {
        $orderBy = $this->formatOrderByField($request->orderby);
        $limit = $request->limit ? $request->limit : 20;
        $searchString = $request->input('search') ? $request->search : '';
        $products = Products::where(function ($q) use ($searchString) {
            $q->where('name', 'LIKE', '%' . $searchString . '%')
                ->orWhere('description', 'LIKE', '%' . $searchString . '%')
                ->orWhereHas(
                    'category',
                    function ($query) use ($searchString) {
                        $query->where('name', 'LIKE', '%' . $searchString . '%');
                    }
                );

        })->orderBy($orderBy['field'], $orderBy['order'])
            ->paginate($limit);

        return response()->json([
            'data' => $products
        ], 200);
    }

    public function formatOrderByField($orderby)
    {
        return match ($orderby) {
            'Low to High' => ['field' => 'price', 'order' => 'ASC'],
            'High to Low' => ['field' => 'price', 'order' => 'DESC'],
            'Relevance' => ['field' => 'created_at', 'order' => 'DESC']
        };
    }
}
