<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatsController;
use App\Http\Controllers\DishesController;
use App\Http\Controllers\PeoplesController;
use App\Http\Controllers\ToysController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(CatsController::class)->group(function(){
    Route::get('cats', 'getCats');
    Route::post('cats', 'create');
    Route::get('cats/{id}', 'getcat');
    Route::delete('cats/{id}', 'destroy');
    Route::patch('cats', 'update');
    Route::post('cat/{cat_id}/dish/{dish_id}', 'createDishCat');
});

Route::controller(DishesController::class)->group(function(){
    Route::get('dishes', 'getDishes');
    Route::post('dishes', 'create');
    Route::get('dishes/{id}', 'getDish');
    Route::delete('dishes/{id}', 'destroy');
    Route::patch('dishes', 'update');
});

Route::controller(PeoplesController::class)->group(function(){
    Route::get('peoples', 'getPeoples');
    Route::post('peoples', 'create');
    Route::get('peoples/{id}', 'getPeople');
    Route::delete('peoples/{id}', 'destroy');
    Route::patch('peoples', 'update');
    Route::post('peoples/{people_id}/cats/{cat_id}', 'createPeopleCat');
});

Route::controller(ToysController::class)->group(function(){
    Route::get('Toy', 'getToys');
    Route::post('Toy', 'create');
    Route::get('Toy/{id}', 'getToys');
    Route::delete('Toy/{id}', 'destroy');
    Route::patch('Toy', 'update');
    Route::post('toys/{toy_id}/cats/{cat_id}', 'createToyCat');
});