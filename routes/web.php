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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::resource('artist', 'ArtistController');

Route::resource('representation', 'RepresentationController');
Auth::routes();

Route::get('/user', 'UserController@edit')
    ->middleware('auth')
    ->name('user.edit');
Route::post('/user/{id}', 'UserController@update')
    ->middleware('auth')
    ->name('user.update');

Route::resource('reservation', 'ReservationController');
Route::resource('shows', 'ShowController');
Route::resource('location', 'LocationController');


Route::resource('artist-type', 'ArtisteTypeController');
Route::get('artist-type/editForArtist/{id}', 'ArtisteTypeController@editForArtist')
    ->name('artistType.editForArtist');
Route::get('artist-type/addArtistType/{id}', 'ArtisteTypeController@addArtistType')
    ->name('artistType.addArtistType');

Route::resource('collaboration', 'CollaborationController');
Route::get('collaboration/editForShow/{id}', 'CollaborationController@editForShow')
    ->name('collaboration.editForShow');
Route::get('collaboration/addCollaboration/{id}', 'CollaborationController@addCollaboration')
    ->name('collaboration.addCollaboration');


// Ajouter routes pour RSS
Route::feeds('feeds');

Route::get('exportCSV', 'ShowController@exportCSV')
    ->name('shows.exportCSV');
Route::post('importCSV', 'ShowController@importCSV')
    ->name('shows.importCSV');


Route::get('/', function () {
    return redirect('shows');
});


Route::resource('localities', 'LocalityController');
Route::resource('locations', 'LocationController');