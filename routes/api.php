<?php

use App\Http\Controllers\api_frontend\HomeController;
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



/***************************** API WITHOUT AUTHENTICATION */

    Route::controller(HomeController::class)->prefix('v1')->group(function(){
        //Principal Category list with subcategory and media
        Route::get('/principalCategory', 'principalCategory');

        //Section Category list with media
        Route::get('/sectionCategory', 'sectionCategory');

        //Slider
        Route::get('/slider', 'slider');

        //Section Category pack with products

        Route::get('/CategoryPack', 'CategoryPack');




    });





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
