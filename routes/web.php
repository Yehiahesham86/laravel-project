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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/ajax', [App\Http\Controllers\ajax::class, 'index']);
Route::post('/ajax', [App\Http\Controllers\ajax::class, 'add'])->name('ajax');

Route::get('/fetch',[App\Http\Controllers\order::class, 'fetch'] )->name('fetch');
Route::post('/pro',[App\Http\Controllers\order::class, 'pro'] )->name('pro');
Route::post('/customer',[App\Http\Controllers\order::class, 'customer'] )->name('customer');
 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/order',[App\Http\Controllers\order::class, 'add'] )->name('order');
Route::post('/order',[App\Http\Controllers\order::class, 'new_add'] )->name('addorder');

//Route::get('/delete',[App\Http\Controllers\order::class, 'delete'] )->name('delorder1');
Route::post('/delete',[App\Http\Controllers\order::class, 'delete'] )->name('delorder');

//Route::get('/update',[App\Http\Controllers\order::class, 'update'] )->name('update');
Route::post('/update',[App\Http\Controllers\order::class, 'update'] )->name('update');


Route::get('/profile',[App\Http\Controllers\profile::class, 'profile'] )->name('profile');
Route::post('/profile',[App\Http\Controllers\profile::class, 'profile'] )->name('editprofile');

Route::Post('/total',[App\Http\Controllers\total::class, 'total'] )->name('total');
//Route::post('/total',[App\Http\Controllers\total::class, 'total'] )->name('total1');

Route::get('/totalPage',[App\Http\Controllers\totalPage::class, 'index'] )->name('totalpage');
Route::post('/totalpage',[App\Http\Controllers\totalPage::class, 'total'] )->name('totalpage1');
Route::post('/showmore',[App\Http\Controllers\totalPage::class, 'showmore'] )->name('showmore');

