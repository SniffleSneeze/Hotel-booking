<?php

use App\Http\Controllers\ShowRoomsController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', function() {return "Goodbye";});

Route::get('/rooms', ShowRoomsController::class);

Route::get('/bookings',[App\Http\Controllers\BookingController::class, 'index']);
Route::get('/bookings/create',[App\Http\Controllers\BookingController::class, 'create']);
Route::post('/bookings',[App\Http\Controllers\BookingController::class, 'store']);


