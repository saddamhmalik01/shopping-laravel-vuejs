<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = loggedInUser();
        if (is_null($user)) {
            return errorResponse('please login first');
        }
        $quantity = $request->input('quantity') ? $request->quantity : 1;
        $cart = $user->cart()->where('product_id', $request->product_id)->get()->count();
        ($cart > 0) ?
            $user->cart()->where('product_id', $request->product_id)->update(['quantity' => $quantity]) :
            $user->cart()->create([
                'product_id' => $request->product_id,
                'quantity' => $quantity
            ]);
        return successResponse('Cart updated');
    }

    public function deleteFromCart(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = loggedInUser();
        if (is_null($user)) {
            return errorResponse('please login first');
        }
        $user->cart()->where('product_id', $request->product_id)->delete();
        return successResponse('Cart updated');
    }

    public function userCart(): \Illuminate\Http\JsonResponse
    {
        $user = loggedInUser();
        if (is_null($user)) {
            return errorResponse('please login first');
        }
        $cart = $user->cart;
        $updatedCart = $this->formatCartData($cart);
        return successResponse('success', $updatedCart);
    }

    private function formatCartData($cart): array
    {
        $formattedCart = [];
        $cartTotal = 0;
        foreach ($cart as $cartItem) {
            $item['id'] = $cartItem->product_id;
            $item['name'] = $cartItem->product->name;
            $item['image_url'] = $cartItem->product->image_url;
            $item['quantity'] = $cartItem->quantity;
            $item['created_at'] = $cartItem->created_at->format('m/d/Y');
            $item['price'] = $cartItem->product->price;
            $item['total'] = $cartItem->product->price * $item['quantity'];
            $formattedCart['item'][] = $item;
            $cartTotal = $cartTotal + $item['total'];
        }
        $formattedCart['total'] = $cartTotal;
        return $formattedCart;
    }

    public function checkOutCart(): \Illuminate\Http\JsonResponse
    {
        $user = loggedInUser();
        if (is_null($user)) {
            return errorResponse('please login first');
        }
        $cart = $user->cart;
        $products = [];
        $total = 0;
        foreach ($cart as $cartItem) {
            $product['name'] = $cartItem->product->name;
            $product['quantity'] = $cartItem->quantity;
            $product['price'] = $cartItem->product->price;
            $products[] = $product;
            $total = $total + $product['price'] * $product['quantity'];
        }
        $products['total'] = $total;
        return successResponse('success', $products);
    }
}
