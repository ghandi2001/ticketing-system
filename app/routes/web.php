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
Route::middleware('auth')->group(function () {
    \App\Http\Controllers\UnitController::routes();
    \App\Http\Controllers\TicketPriorityController::routes();
    \App\Http\Controllers\TicketTypeController::routes();
    \App\Http\Controllers\AnswersController::routes();
    \App\Http\Controllers\UserController::routes();
    \App\Http\Controllers\TicketController::routes();
    \App\Http\Controllers\RoleController::routes();
    \App\Http\Controllers\ReportController::routes();
    \App\Http\Controllers\MessageController::routes();
    \App\Http\Controllers\HomeController::routes();
});
\App\Http\Controllers\AuthController::routes();

