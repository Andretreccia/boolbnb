<?php

use App\Models\Service;
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



Route::get('/', 'Guest\ApartmentController@index')->name('hompepageGuest');

Route::get('research', function () {
    $services = Service::all();

    return view('guest.advancedSearch.index', compact('services'));
})->name('advanced.search');




Auth::routes();

Route::namespace('Guest')->prefix('guest')->name('guest.')->group(function () {
    Route::get('apartments/{apartment:slug}', 'ApartmentController@show')->name('apartments.show');
});

Route::middleware('auth')->prefix('registered')->namespace('Registered')->name('registered.')->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::resource('apartments', 'ApartmentController');
});