<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api_frontend\AuthController;
use App\Http\Controllers\api_frontend\HomeController;
use App\Http\Controllers\api_frontend\ProductController;

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



/***************************** API WITHOUT AUTHENTICATION */
Route::prefix('v1')->group(function () {

    Route::controller(HomeController::class)->group(function () {
        //Principal Category list with subcategory and media
        Route::get('/principalCategory', 'principalCategory');

        //Section Category list with media
        Route::get('/sectionCategory', 'sectionCategory');

        //Slider
        Route::get('/slider', 'slider');

        //Section Category pack with products
        Route::get('/categoryPack', 'CategoryPack');

        // quelques produits sur la page accueil
        Route::get('/someProduct', 'someProduct');

    });


    Route::controller(ProductController::class)->group(function () {
        // Detail d'un produit et les produit en relation
        Route::get('/detailProduct', 'detailProduct');
        // Liste de tous les produits || ou avec parametre 
        Route::get('/allProduct', 'allProduct');
    });


    Route::controller(AuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::get('auth', 'auth')->middleware('auth:sanctum');
        Route::post('logout', 'logout')->middleware('auth:sanctum');
    });


});






Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
