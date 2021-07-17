<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes

*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [IndexController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/add-categories', [CategoryController::class , 'store']);
Route::get('/edit-category/{id}', [CategoryController::class , 'edit']);
Route::post('/update-category/{id}', [CategoryController::class , 'update']);
Route::get('/delete-category/{id}', [CategoryController::class, 'destroy']);
