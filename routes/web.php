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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');
Route::get('/users', 'UserController@index')->name('user.index')->middleware('is_admin');

/***
 * Countries
 */

Route::resource('admin/countries', 'CountryController')->middleware('is_admin');
Route::delete('/countries/{id}/delete', 'CountryController@delete')->name('countries.delete');
Route::get('/countries/trash', 'CountryController@trash')
->name('countries.trash');
Route::get('/countries/trash/{id}/restore', 'CountryController@restore')
->name('countries.restore');
Route::delete('/countries/trash/{id}/permanent-delete', 'CountryController@permanentDelete')
->name('countries.permanent-delete');

/***
 * Tracks
 */
Route::resource('admin/tracks', 'TrackController')->middleware('is_admin');
Route::delete('/tracks/{id}/delete', 'TrackController@delete')->name('tracks.delete');
Route::get('/tracks/trash', 'TrackController@trash')
->name('tracks.trash');
Route::get('/tracks/trash/{id}/restore', 'TrackController@restore')
->name('tracks.restore');
Route::delete('/tracks/trash/{id}/permanent-delete', 'TrackController@permanentDelete')
->name('tracks.permanent-delete');

/***
 * Races
 */
Route::resource('admin/races', 'RaceController')->middleware('is_admin');
Route::delete('/races/{id}/delete', 'RaceController@delete')->name('races.delete');
Route::get('/races/trash', 'RaceController@trash')->name('races.trash');
Route::get('/races/trash/{id}/restore', 'RaceController@restore')->name('races.restore');
Route::delete('/races/trash/{id}/permanent-delete', 'RaceController@permanentDelete')->name('races.permanent-delete');

/***
 * Constructors
 */
Route::resource('admin/constructors', 'ConstructorController')->middleware('is_admin');
Route::delete('/constructors/{id}/delete', 'ConstructorController@delete')->name('constructors.delete');
Route::get('/constructors/trash', 'ConstructorController@trash')->name('constructors.trash');
Route::get('/constructors/trash/{id}/restore', 'ConstructorController@restore')->name('constructors.restore');
Route::delete('/constructors/trash/{id}/permanent-delete', 'ConstructorController@permanentDelete')->name('constructors.permanent-delete');

/***
 * Drivers
 */
Route::resource('admin/drivers', 'DriverController')->middleware('is_admin');
Route::delete('/drivers/{id}/delete', 'DriverController@delete')->name('drivers.delete');
Route::get('/drivers/trash', 'DriverController@trash')->name('drivers.trash');
Route::get('/drivers/trash/{id}/restore', 'DriverController@restore')->name('drivers.restore');
Route::delete('/drivers/trash/{id}/permanent-delete', 'DriverController@permanentDelete')->name('drivers.permanent-delete');

/***
 * Results
 */
Route::resource('admin/results', 'ResultsController')->middleware('is_admin');
Route::get('/admin/results/{id}/create', 'ResultsController@edit')->name('results.create');
Route::get('/admin/results/{id}/single', 'ResultsController@singleResults')->name('results.test');


Route::get('/picks/create/{id}', 'PickController@pick')->name('picks.pick');
Route::get('/results/{race_id}', 'PickController@results')->name('picks.results');
Route::resource('/picks', 'PickController');

Route::get('logActivity', 'HomeController@logActivity')->middleware('is_admin');
Route::get('logActivity/clearLogs', 'HomeController@clearLogs')->middleware('is_admin');

//Route::get('admin/pickReport', 'ReportController@index')->middleware('is_admin');
Route::get('admin/pickReport/{userid}/{raceid}', 'ReportController@pickreport');
Route::get('admin/standingsReport', 'ReportController@playerStandingsReport');

Route::get('/user/{id}', 'UserController@profile')->name('user.profile');

Route::get('/edit/user', 'UserController@edit')->name('user.edit');
Route::post('/edit/user', 'UserController@update')->name('user.update');

Route::get('/edit/password/user', 'UserController@passwordEdit')->name('password.edit');
Route::post('/edit/password/user', 'UserController@passwordUpdate')->name('password.update');

Route::get('/reports', 'ReportController@index')->name('reports');
Route::get('/reports/driver/{id}', 'ReportController@driver')->name('report.driver');
Route::get('/reports/constructor/{id}', 'ReportController@constructor')->name('report.constructor');
Route::get('/reports/player/{id}', 'ReportController@player')->name('report.player');

?>
