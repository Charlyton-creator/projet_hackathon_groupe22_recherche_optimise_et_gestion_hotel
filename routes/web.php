<?php

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

Route::get('/', function () {
    return redirect(route('login'));
});
Route::get('/stats', function () {
    return view('dashboard/gestionnaires/stats_view');
});
//----------------------------------------------------------
Route::controller(App\Http\Controllers\AdminController::class)->group(function(){
    Route::get('/login/index', 'loginindex')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth.admins');
    Route::get('/dashboard', 'dashboard')->name('dashboard')->middleware('auth.globals');
});

Route::controller(App\Http\Controllers\HotelController::class)->group(function(){
    Route::get('/hotels', 'index')->middleware('auth.admins')->name('allhotels');
    Route::get('/hotel/{id}', 'getHotelById')->middleware('auth.admins')->name('hotel');
    Route::get('/hotels/add/index', 'addindex');
    Route::post('/registerhotel', 'register');
});

Route::controller(App\Http\Controllers\GestionnaireController::class)->group(function($id = null){
    Route::get('/gestionnaires/{id?}', 'index')->middleware('auth.admins');
    Route::get('/gestionnaire/add', 'registerindex');
    Route::post('/registergestionnaire', 'register');
    Route::post('/gestionnaire/logout', 'logout');
});