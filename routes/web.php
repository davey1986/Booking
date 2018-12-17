<?php

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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', 'DashboardController@roomCount');
Route::get('ajax_room_count', 'RoomController@roomCount');

Auth::routes();

//Test route
Route::get('/test', 'DashboardController@test')->name('test');

//Main routes
Route::get('check_out/{id}/{guest_id}','RoomController@check_out')->name('check_out');
Route::get('cancel_reservation/{id}/{guest_id}','RoomController@cancel_reservation')->name('cancel_reservation');

Route::get('check_in/{id}', 'RoomController@check_in')->name('check_in');
Route::post('check_in_guest', 'BookingController@store')->name('check_in_guest');

Route::get('clean_room/{id}', 'RoomController@clean_room')->name('clean_room');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/rooms', 'DashboardController@rooms')->name('rooms');
Route::get('/facilities', 'DashboardController@facilities')->name('facilities');

Route::get('admin', 'RoomController@index');
Route::get('admin/room/{id}', 'RoomController@show');

//Room Options
Route::post('room_store', 'RoomController@store');
Route::get('room_add', 'RoomController@create');
Route::get('/admin/room_delete/{id}', 'RoomController@destroy');
// Route::get('/admin/room_prices/{id}', 'RoomController@update');

Route::get('/ajax_room_bed/{id}/{beds}', 'RoomController@updateBeds');
Route::get('/ajax_room_price/{id}/{cost}', 'RoomController@update');

Route::get('search_room', 'RoomController@search');
Route::get('check_in_dates', 'RoomController@search');
Route::get('admin/ajax-room_search/{checkIn}/{checkOut}', 'RoomController@ajax_room_search' );

// Guest and Bookings
Route::get('admin/guests/index', 'GuestController@index');
Route::get('admin/guests/view/{id}', 'GuestController@show');
