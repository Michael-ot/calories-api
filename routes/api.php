<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuth;
use App\Http\Controllers\FoodController;

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

Route::group([
    'middleware' => ['cors'],
], function () {
     //Add you routes here, for example:
        Route::post('/auth/login', [CustomAuth::class, 'login']);


        Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
            return $request->user();
        });

        Route::group(['middleware' => ['auth:sanctum']], function () {

            Route::post('/food', [FoodController::class, 'create']);
            Route::post('/food/delete/{id}', [FoodController::class, 'deletefood']);
            Route::post('/food/update/{id}', [FoodController::class, 'updateFood']);
            Route::get("/food", [FoodController::class,"getFoods" ]);
            Route::get("/food/all", [FoodController::class,"getAllFoods" ]);
        });

});
