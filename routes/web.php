<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinishingController;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\FurnitureImageController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceSelectController;
use App\Http\Controllers\Material1Controller;
use App\Http\Controllers\Material2Controller;
use App\Http\Controllers\Material3Controller;
use App\Http\Controllers\Material4Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderSelectController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard', [
//         'page' => 'dashboard'
//     ]);
// })->name('dashboard');

// Route::get('/login', function () {
//     return view('auth.login', [
//         'page' => 'login'
//     ]);
// })->name('login');

// Route::get('/register', function () {
//     return view('auth.register', [
//         'page' => 'register'
//     ]);
// })->name('register');

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::middleware(['auth'])->group(function () {

    // Route::get('/', function () {return view('dashboard',['page' => 'dashboard']);})->name('dashboard');
    // Route::get('/login', function () {return redirect('/');})->name('dashboard');
    // Route::get('/register', function () {return redirect('/');})->name('dashboard');

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('/', DashboardController::class);
    Route::resource('/furnitures', FurnitureController::class);
    Route::resource('/images', FurnitureImageController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/material1s', Material1Controller::class);
    Route::resource('/material2s', Material2Controller::class);
    Route::resource('/material3s', Material3Controller::class);
    Route::resource('/material4s', Material4Controller::class);
    Route::resource('/finishings', FinishingController::class);
    Route::resource('/applications', ApplicationController::class);
    Route::resource('/suppliers', SupplierController::class);
    Route::resource('/orders', OrderController::class);
    Route::resource('/order_selects', OrderSelectController::class);
    Route::resource('/invoices', InvoiceController::class);
    Route::resource('/invoice_selects', InvoiceSelectController::class);

});
