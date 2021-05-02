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

 Route::get('/home', 'HomeController@index');

 Route::get('/test','HomeController@test');
 Route::get('/','RapportController@choice')->name('rapport.choice');
 Route::get('/bioStarV1','Rapport2Controller@choice')->name('rapport2.choice');


 Route::prefix('rapports')->group(function(){

    Route::get('users/{names}','RapportController@rapportUserByEndMonth')->name('rapport.month');
    Route::get('days/works/{names}','RapportController@rapportUserByDayWork')->name('rapport.days.works');
    Route::get('semaine/works/{names}','RapportController@rapportUserByDayWeek')->name('rapport.days.week');

    Route::get('users/days/Absent/{names}','RapportController@rapportUserByDayAbsent')->name('rapport.days.absent');
    Route::get('users/times/retard/matin/{names}','RapportController@rapportUserByTimesRetardMatin')->name('rapport.times.retard.matin');
    Route::get('users/times/retard/soir/{names}','RapportController@rapportUserByTimesRetardSoir')->name('rapport.times.retard.soir');


    Route::get('csv/bistart/{type}','ExportController@csvBiostarExport')->name('rapport.csvBiostarExport');
    Route::get('pdf/bistart','ExportController@pdfBiostar')->name('rapport.pdfBiostar');
    Route::get('choice/presence','RapportController@choicePresence')->name('rapport.choice.presence');
    Route::get('choice/retard','RapportController@choiceRetard')->name('rapport.choice.retard');
    Route::get('redirect','RapportController@redirect')->name('rapport.redirect');
    Route::get('users/date/absent/{names}','RapportController@rapportUserAbsencesByDate')->name('rapport.absence.date');


 });
 Route::prefix('rapports2')->group(function(){

    Route::get('users/heureEntrer/{names}','Rapport2Controller@heureEntrer')->name('rapport2.heureEntrer');
    Route::get('users/heureSorties/matin/{names}','Rapport2Controller@heureSortiesmartin')->name('rapport2.heureSortiesmartin');
    Route::get('users/heureSorties/soir/{names}','Rapport2Controller@heureSortiesSoir')->name('rapport2.heureSortiesSoir');


    Route::get('rapport/date/search/{names}','Rapport2Controller@searchDate')->name('rapport2.search.date');
    Route::get('cumille/absences/search/{names}','Rapport2Controller@cumileAbsences')->name('rapport2.search.cumileAbsences');
    Route::get('cumille/retard/search/{names}','Rapport2Controller@cumilleRetard')->name('rapport2.search.cumilleRetard');



    Route::get('users/month/{names}','Rapport2Controller@rapportUserByEndMonth')->name('rapport2.month');
    Route::get('days/works/{names}','Rapport2Controller@rapportUserByDayWork')->name('rapport2.days.works');
    Route::get('semaine/works/{names}','Rapport2Controller@rapportUserByDayWeek')->name('rapport2.days.week');

    Route::get('users/days/Absent/{names}','Rapport2Controller@rapportUserByDayAbsent')->name('rapport2.days.absences');
    Route::get('users/times/retard/matin/{names}','Rapport2Controller@rapportUserByTimesRetardMatin')->name('rapport2.times.retard.matin');
    Route::get('users/times/retard/soir/{names}','Rapport2Controller@rapportUserByTimesRetardSoir')->name('rapport2.times.retard.soir');

    Route::get('csv/bistart/{type}','ExportController@csvBiostarExport')->name('rapport.csvBiostarExport');
    Route::get('pdf/bistart','ExportController@pdfBiostar')->name('rapport.pdfBiostar');
    Route::get('choice/presence','Rapport2Controller@choicePresence')->name('rapport2.choice.presence');
    Route::get('choice/retard','Rapport2Controller@choiceRetard')->name('rapport2.choice.retard');
    Route::get('redirect','Rapport2Controller@redirect')->name('rapport2.redirect');
    Route::get('users/date/absent/{names}','Rapport2Controller@rapportUserAbsencesByDate')->name('rapport2.absence.date');

    Route::get('seache/users/date/{name}','Rapport2Controller@searchDateByallUser')->name('rapport2.search.alluser');


 });
