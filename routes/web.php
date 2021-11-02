<?php

use App\Http\Controllers\ShowRoomsController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/rooms/{roomType?}', ShowRoomsController::class);


/**
 * this is the traditional way to do a route in an MVC framework,
 * you would set a rout for each different action.
 */
//Route::get('/bookings',[App\Http\Controllers\BookingController::class, 'index']);
//Route::get('/bookings/create',[App\Http\Controllers\BookingController::class, 'create']);
//Route::get('/bookings/{booking}',[App\Http\Controllers\BookingController::class, 'show']);
//Route::get('/bookings/{booking}/edit',[App\Http\Controllers\BookingController::class, 'edit']);
//Route::post('/bookings',[App\Http\Controllers\BookingController::class, 'store']);
//Route::put('/bookings/{booking}',[App\Http\Controllers\BookingController::class, 'update']);
//Route::delete('/bookings/{booking}',[App\Http\Controllers\BookingController::class, 'destroy']);


/**
 * Laravel allow us to compact all those rout in one line of code.
 */
Route::resource('bookings',App\Http\Controllers\BookingController::class);
Route::resource('room_types',App\Http\Controllers\RoomTypeController::class);




