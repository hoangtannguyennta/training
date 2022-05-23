<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PubController;

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

Route::group(['prefix' => 'users' , 'as' => 'users.'],function(){
	Route::get('/',[UserController::class, 'index'])->name('index');
	Route::get('/create',[UserController::class, 'create'])->name('create');
	Route::post('/create',[UserController::class, 'store'])->name('store');
	Route::get('/edit/{id}',[UserController::class, 'edit'])->name('edit');
	Route::post('/edit/{id}',[UserController::class, 'update'])->name('update');
	Route::post('/delete/{id}',[UserController::class, 'destroy'])->name('delete');
});

Route::group(['prefix' => 'pubs' , 'as' => 'pubs.'],function(){
	Route::get('/',[PubController::class, 'index'])->name('index');
	Route::get('/create',[PubController::class, 'create'])->name('create');
	Route::post('/create',[PubController::class, 'store'])->name('store');
	Route::get('/edit/{id}',[PubController::class, 'edit'])->name('edit');
	Route::post('/edit/{id}',[PubController::class, 'update'])->name('update');
	Route::post('/delete/{id}',[PubController::class, 'destroy'])->name('delete');
});

