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

Route::apiResource('banks', \App\Http\Controllers\BankController::class);
Route::apiResource('creditCards',\App\http\Controllers\CreditCardController::class);
Route::apiResource('accounts', \App\Http\Controllers\AccountController::class);

Route::post('accounts/{account_id}/creditCards', [\App\Http\Controllers\CreditCardController::class, 'store']);
Route::get('accounts/{account_id}/creditCards', [\App\Http\Controllers\CreditCardController::class, 'showAll']);
Route::get('accounts/{account_id}/creditCards/{card_id}', [\App\Http\Controllers\CreditCardController::class, 'show']);
