<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::name('api.')->prefix('v1')->group(function(){
    Route::post('/login',[App\Http\Controllers\API\AuthController::class,'login'])->name('login');
    Route::post('/register',[App\Http\Controllers\API\AuthController::class,'register'])->name('register');
    
    Route::post('/sanctum/token', function(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::resource('products',App\Http\Controllers\API\ProductAPIController::class);
        Route::resource('product-attributes',App\Http\Controllers\API\ProductAttributeAPIController::class);
        Route::get('newest-products',[App\Http\Controllers\API\ProductAPIController::class,'getNewestProduct']);
        Route::resource('categories',App\Http\Controllers\API\CategoryAPIController::class);
        Route::resource('orders',App\Http\Controllers\API\OrderAPIController::class);
        Route::resource('order-items',App\Http\Controllers\API\OrderItemAPIController::class);
        Route::resource('carts',App\Http\Controllers\API\CartAPIController::class);
        Route::resource('cart-items',App\Http\Controllers\API\CartItemAPIController::class);
        Route::resource('brands',App\Http\Controllers\API\BrandAPIController::class);

    });

});
