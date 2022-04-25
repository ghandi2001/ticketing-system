<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware'=>'auth'],function (){
    \App\Http\Controllers\UnitController::routes();
    \App\Http\Controllers\TicketGroupController::routes();
    \App\Http\Controllers\TicketPriorityController::routes();
    \App\Http\Controllers\TicketTypeController::routes();
    \App\Http\Controllers\ReadyAnswersController::routes();
    \App\Http\Controllers\UserController::routes();
    Route::get('/', [\App\Http\Controllers\AuthController::class, 'dashboard'])->name('dashboard');
});
\App\Http\Controllers\AuthController::routes();

