<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;

/*
|--------------------------------------------------------------------------
| Web Routes

*/

// DASHBOARD ROUTES
Route::get('/', [IndexController::class, 'index']);

// CATEGORY ROUTES
Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/add-categories', [CategoryController::class , 'store']);
Route::get('/edit-category/{id}', [CategoryController::class , 'edit']);
Route::post('/update-category/{id}', [CategoryController::class , 'update']);
Route::get('/delete-category/{id}', [CategoryController::class, 'destroy']);

// AUTHOR ROUTES
Route::get('/categories', [AuthorController::class, 'index']);
Route::post('/add-authors', [AuthorController::class , 'store']);
Route::get('/edit-author/{id}', [AuthorController::class , 'edit']);
Route::post('/update-author/{id}', [AuthorController::class , 'update']);
Route::get('/delete-author/{id}', [AuthorController::class, 'destroy']);