<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ContactPersonController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::resource('contacts', App\Http\Controllers\API\ContactAPIController::class)
    ->except(['create', 'edit']);

Route::resource('add', ContactPersonController::class);

Route::resource('personnes', App\Http\Controllers\API\PersonneAPIController::class)
    ->except(['create', 'edit']);

Route::resource('contacts', App\Http\Controllers\API\ContactAPIController::class)
    ->except(['create', 'edit']);

