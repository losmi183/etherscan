<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

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

// Fetch transaction data from API and save to local DB
Route::get('/transactions-fetch', [TransactionController::class, 'transactionsFetch']);
Route::post('/transactions', [TransactionController::class, 'transactions']);
Route::get('/wallet', [TransactionController::class, 'wallet']);
