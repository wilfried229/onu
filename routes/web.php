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

/* Route::get('/', function () {
    return view('welcome');
});
 */

 Route::get('/', 'HomeController@index');

 Route::prefix('rapports')->group(function(){

    Route::get('users','RapportController@rapportUserByEndMonth')->name('rapport.users');
    Route::get('days/works','RapportController@rapportUserByDayWork')->name('rapport.days.words');
    Route::get('users/days/Absent','RapportController@rapportUserByDayAbsent')->name('rapport.days.absent');
    Route::get('users/times/retard','RapportController@rapportUserByTimesRetard')->name('rapport.times.retard');

 });
