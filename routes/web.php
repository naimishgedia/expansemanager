<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpanseCategoryController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\DailyExpanseController;
  
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
Route::get('register', [LoginController::class, 'registerFunction'])->name('register');
Route::post('do_register', [LoginController::class, 'do_registerFunction'])->name('do_register');
Route::get('login', [LoginController::class, 'loginFunction'])->name('login');
Route::post('do_login', [LoginController::class, 'do_loginFunction'])->name('do_login');
Route::get('logout', [LoginController::class, 'logoutFunction'])->name('logout');

Route::middleware(['auth'])->group(function () {
	Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('changepassword', [DashboardController::class, 'changepasswordFunction'])->name('changepassword');
	Route::post('/change-password', [DashboardController::class, 'changePassword'])->name('change-password');
	
	Route::get('expanse-category', [ExpanseCategoryController::class, 'index'])->name('expanse_category');
	Route::post('insert-newcategory', [ExpanseCategoryController::class, 'insertnewcategoryFunction'])->name('insertnewcategory');
	Route::post('edit-expcategory', [ExpanseCategoryController::class, 'editexpcategory'])->name('editexpcategory');
	Route::post('update-expcataegory', [ExpanseCategoryController::class, 'updateexpcataegory'])->name('updateexpcataegory');
	Route::post('delete-expcategory', [ExpanseCategoryController::class, 'deleteexpcategory'])->name('deleteexpcategory');
	Route::post('save-subexpansecategory', [ExpanseCategoryController::class, 'save_subexpansecategory'])->name('save_subexpansecategory');
	Route::post('delete_subexpansecategory', [ExpanseCategoryController::class, 'delete_subexpansecategory'])->name('delete_subexpansecategory');
	
	Route::get('income-category', [IncomeCategoryController::class, 'index'])->name('income_category');
	Route::post('insert-income-category', [IncomeCategoryController::class, 'insertnew_incomecategoryFunction'])->name('insertnew_incomecategory');
	Route::post('edit-income-category', [IncomeCategoryController::class, 'editincomecategoryFunction'])->name('editincomecategory');
	Route::post('update-income-cataegory', [IncomeCategoryController::class, 'updateincomecataegoryfunction'])->name('updateincomecataegory');
	Route::post('delete-income-category', [IncomeCategoryController::class, 'deleteincomecategoryFunction'])->name('deleteincomecategory');

	//Daily Expanse
	Route::get('daily-expanse', [DailyExpanseController::class, 'index'])->name('daily_expanse');
	

});
















