<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ContactPersonController;
use App\Http\Controllers\API\ContactAPIController;
use App\Http\Controllers\API\PersonneAPIController;
<<<<<<< HEAD
use App\Http\Controllers\API\FicheAPIController;

=======
>>>>>>> parent of 61a3dd0 (CRUD Fiche + Search Manager)

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


Route::resource('contacts', ContactAPIController::class);
Route::get('/contacts/deleted', [ContactAPIController::class, 'deletedContacts']);
Route::resource('personnes', PersonneAPIController::class);
<<<<<<< HEAD


Route::resource('fiches', FicheAPIController::class);
=======
>>>>>>> parent of 61a3dd0 (CRUD Fiche + Search Manager)
