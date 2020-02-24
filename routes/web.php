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

Route::get('', function () {
  return redirect('dashboard');
});

Auth::routes();

Route::get('dashboard', 'HomeController@index')->name('dashboard');
Route::get('meetings', 'HomeController@indexMeetings')->name('meetings');
Route::get('next_steps', 'HomeController@indexNextSteps')->name('next_steps');
Route::get('contacts', 'HomeController@indexContacts')->name('contacts');
Route::get('account', 'HomeController@accountDetails')->name('account');

Route::prefix('plan')->name('plan.')->group(function() {
  foreach([
    "new",
    "details",
    "attendees",
    "agenda",
    "objectives",
    "summary"
  ] as $step) {
    Route::get($step.'/{meeting}', 'PlanController@'.$step)->name($step);
  }
});

Route::prefix('run')->name('run.')->group(function() {
  Route::get('', 'RunController@choose')->name('choose');
  Route::get('{meeting?}', 'RunController@run')->name('run');
});

Route::prefix('ajax')->group(function() {
  Route::get('my_meetings', 'AjaxController@meetings');
  Route::get('my_next_steps', 'AjaxController@next_steps');
  Route::get('my_meetings_run', 'AjaxController@run_choose_meetings');
});
