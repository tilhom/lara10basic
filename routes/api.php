<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\Category2Controller;

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


Route::controller(CategoryController::class)->group( function() {
    Route::get('/categories', 'index');
    Route::post('/categories', 'store');
    Route::get('/categories/{id}', 'show');
    Route::put('/categories/{id}', 'update');
    Route::delete('/categories/{id}', 'destroy');
});

Route::get('/categories2', [Category2Controller::class,'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
