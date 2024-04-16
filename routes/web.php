<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegistrationController;

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


Route::controller(LoginRegistrationController::class)->group(function(){
    Route::get('/register','register')->name('register');
    Route::post('/store','store')->name('store');
    Route::get('/login','login')->name('login');
    Route::post('/authentication','authentication')->name('authentication');
    Route::get('/dashboard','dashboard')->name('dashboard');
    Route::get('/profile','profile')->name('profile');
    Route::post('/logout','logout')->name('logout');
});
