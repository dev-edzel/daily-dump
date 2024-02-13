<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('register', [RegisterController::class, 'store'])->name('register');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::post('customers', [CustomerController::class, 'store'])->name('customer.store');

Route::get('roles', [RoleController::class, 'index'])->name('roles.index');

Route::group(['middleware' => ['auth.jwt']], function () {
});
