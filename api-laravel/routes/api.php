<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Dashboard\TransactionDashboardController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/auth/user', function (Request $request) {
    return response()->json([
        'user' => $request->user()
    ]);
});

Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::post('create', 'store');
});

Route::controller(LoginController::class)->prefix('auth')->group(function () {
    Route::post('login', 'index');
});

Route::controller(TransactionController::class)->prefix('transaction')->group(function () {
    Route::post('create', 'store')->name('transaction.create');
    Route::get('get-by-user_id/{user_id}', 'showByUserId');
    Route::delete('delete/{id}', 'destroy');
});

Route::prefix('dashboard')->group(function () {

    Route::controller(TransactionDashboardController::class)
        ->prefix('transaction')->group(function () {
            Route::get('sum-cards/{user_id}', 'sumCards');
            Route::get('e-sum-by-day/{user_id}', 'eSumByDay');
            Route::get('get-graphic-data-by-type', 'graphicDataByType');
        });
});
