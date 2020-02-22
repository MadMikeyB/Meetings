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
  return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('company', 'CompanyController');
//Route::resource('meeting', 'MeetingController');
//Route::resource('agendaitem', 'AgendaItemController');
//Route::resource('attendee', 'AttendeeController');
//Route::resource('benefit', 'BenefitController');
//Route::resource('concern', 'ConcernController');
//Route::resource('day', 'DayController');
//Route::resource('decision', 'DecisionController');
//Route::resource('expectation', 'ExpectationController');
//Route::resource('nextstep', 'NextStepController');
//Route::resource('note', 'NoteController');
//Route::resource('objective', 'ObjectiveController');
//Route::resource('token', 'TokenController');
