<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SalesController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return response()->json($request->user());
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware('auth:api')->group(function () {
    Route::get('sales', [SalesController::class, 'index']);
    Route::get('sales/{id}', [SalesController::class, 'show']);
    Route::get('sales/user/{id}', [SalesController::class, 'showByUser']);
    Route::post('sales', [SalesController::class, 'store']);
    Route::put('sales/{id}', [SalesController::class, 'update']);
    Route::delete('sales/{id}', [SalesController::class, 'destroy']);
});

