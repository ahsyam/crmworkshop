<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NotesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('customers/{id}', [CustomerController::class,'show']);
Route::patch('customers/{id}', [CustomerController::class,'update']);
Route::delete('customers/{id}', [CustomerController::class,'delete']);
Route::post('customers', [CustomerController::class,'create']);
Route::get('customers', [CustomerController::class,'index']);


Route::get('customers/{customerId}/notes/{id}', [NotesController::class,'show']);
Route::patch('customers/{customerId}/notes/{id}', [NotesController::class,'update']);
Route::delete('customers/{customerId}/notes/{id}', [NotesController::class,'delete']);
Route::post('customers/{customerId}/notes', [NotesController::class,'create']);
Route::get('customers/{customerId}/notes', [NotesController::class,'index']);

