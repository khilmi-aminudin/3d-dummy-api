<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DebiturController;
use App\Http\Controllers\Api\AlasanPenolakanController;

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

Route::get('client/debitur', [DebiturController::class, 'index']);
Route::post('client/debitur', [DebiturController::class, 'create']);


Route::get('client/alasan-penolakan', [AlasanPenolakanController::class, 'create']);
