<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesLeadController;
use App\Models\Customer;
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

Route::group(['middleware' => ['auth.jwt']], function () {
    Route::get('customers', [CustomerController::class, 'index'])->can('viewAny', Customer::class)->name('customer.index');
});

Route::post('customers', [CustomerController::class, 'store'])->name('customer.store');

Route::get('roles', [RoleController::class, 'index'])->name('roles.index');

Route::post('sales-leads', [SalesLeadController::class, 'store'])->name('sales.leads.store');

Route::patch('sales-leads/{salesLead}', [SalesLeadController::class, 'update'])->name('sales-leads.update');

