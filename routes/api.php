<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});


# Not authenticated response
Route::get('login', function () {
  return response()->json(['data' => ['status' => 'error', 'message' => 'You are not authenticated']]);
})->name('login');

# User Routes
Route::post('login', [\App\Http\Controllers\Api\Auth\SigninController::class, 'login']);
Route::get('users', [\App\Http\Controllers\Api\User\UserController::class, 'index']);
Route::get('users/{id}', [\App\Http\Controllers\Api\User\UserController::class, 'find']);

# Wallet Routes
Route::get('wallets', [\App\Http\Controllers\Api\Wallet\WalletController::class, 'index']);
Route::get('wallets/{id}', [\App\Http\Controllers\Api\Wallet\WalletController::class, 'find']);
Route::middleware('auth:api')->post('/transfer', [\App\Http\Controllers\Api\Wallet\WalletController::class, 'transfer']);

# Info Route
Route::get('info', [\App\Http\Controllers\Api\BaseController::class, 'getInfo']);
