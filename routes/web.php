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

Route::get('/', function () {
    return view('welcome');
});

// ----------------- API ROUTES -----------------
// List all countries names
Route::get('/api/listCountries', 'APIController@listCountries');

// Create new itinerary
Route::post('/api/newItinerary', 'APIController@newItinerary');
