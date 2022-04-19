<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::group(['prefix'=>'user'],function(){
	Route::get('/',[UserController::class, 'index'])->name('user.index');
	Route::get('/create',[UserController::class, 'create'])->name('user.create');
	Route::post('/create',[UserController::class, 'store'])->name('user.store');
	Route::get('/edit/{id}',[UserController::class, 'edit'])->name('user.edit');
	Route::post('/edit/{id}',[UserController::class, 'update'])->name('user.update');
	Route::post('/delete/{id}',[UserController::class, 'destroy'])->name('user.delete');
});
