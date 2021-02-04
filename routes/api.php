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
Route::post('register',[\App\Http\Controllers\RegisterController::class,'register']);
Route::post('login',[\App\Http\Controllers\RegisterController::class,'login']);
Route::get('auth/me',[\App\Http\Controllers\UserController::class,'me'])->middleware('auth:api');
Route::apiResource('users',\App\Http\Controllers\UserController::class);

Route::apiResource('banks', \App\Http\Controllers\BankController::class);
Route::apiResource('creditCards',\App\http\Controllers\CreditCardController::class);
Route::apiResource('accounts', \App\Http\Controllers\AccountController::class);
Route::apiResource('transactions',\App\Http\Controllers\TransactionController::class)->middleware('auth:api');
Route::post('accounts/{account_id}/creditCards', [\App\Http\Controllers\CreditCardController::class, 'store'])->middleware('auth:api');
Route::get('accounts/{account_id}/creditCards', [\App\Http\Controllers\CreditCardController::class, 'showAll'])->middleware('auth:api');
Route::delete('accounts/{account_id}/creditCards', [\App\Http\Controllers\CreditCardController::class, 'destroy'])->middleware('auth:api');

Route::get('accounts/{account_id}/creditCards/{id}', [\App\Http\Controllers\CreditCardController::class, 'update'])->middleware('auth:api');

Route::get('accounts/{account_id}/creditCards/{card_id}', [\App\Http\Controllers\CreditCardController::class, 'show'])->middleware('auth:api');
Route::get('accounts/{account_id}/transactions', [\App\Http\Controllers\TransactionController::class, 'showUserTransaction'])->middleware('auth:api');


