<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CompanyController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'customers'], function () {
    Route::get('', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('edit/{customer}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('update/{customer}', [CustomerController::class, 'update'])->name('customer.update');
    Route::post('delete/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::get('show/{customer}', [CustomerController::class, 'show'])->name('customer.show');
    Route::post('uploadPhoto/{customer}', [CustomerController::class, 'uploadPhoto'])->name('customer.uploadPhoto');
    Route::post('deletePhoto/{customer}', [CustomerController::class, 'uploadPhoto'])->name('customer.deletePhoto');
});

Route::group(['prefix' => 'companies'], function () {
    Route::get('', [CompanyController::class, 'index'])->name('company.index');
    Route::get('create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('store', [CompanyController::class, 'store'])->name('company.store');
    Route::get('edit/{company}', [CompanyController::class, 'edit'])->name('company.edit');
    Route::post('update/{company}', [CompanyController::class, 'update'])->name('company.update');
    Route::post('delete/{company}', [CompanyController::class, 'destroy'])->name('company.destroy');
    Route::get('show/{company}', [CompanyController::class, 'show'])->name('company.show');
});
