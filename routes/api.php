<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductsController;
use App\Http\Controllers\API\CategoriesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});
Route::get('/categories', [CategoriesController::class, 'getCategories']);

/*
 * Product Controller Routes
 */
Route::controller(ProductsController::class)->group(function () {
    Route::get('/products/category/{category}', 'getCategoryBasedProducts');
    Route::get('/topdeals','topDeals');
    Route::POST('/search','searchProducts');
});



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    /*
     * Cart Controller Routes
     */
    Route::controller(\App\Http\Controllers\API\CartController::class)->group(function () {
        Route::post('/addtocart', 'addToCart');
        Route::post('/removefromcart', 'deleteFromCart');
        Route::get('/cart', 'userCart');
        Route::get('/checkout','checkOutCart');
    });

    /*
     * User Controller Routes
     */
    Route::controller(UsersController::class)->group(function () {
        Route::get('/address', 'userAddress');
    });

});
