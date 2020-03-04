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

Route::name('home.')->group(function() {
  Route::get('dashboard', 'HomeController@index')->name('dashboard');
  Route::get('meetings', 'HomeController@indexMeetings')->name('meetings');
  Route::get('next_steps', 'HomeController@indexNextSteps')->name('next_steps');
  Route::get('contacts', 'HomeController@indexContacts')->name('contacts');
  Route::get('account', 'HomeController@accountDetails')->name('account');
  Route::name('help.')->group(function() {
  });
});

Route::prefix('plan')->name('plan.')->group(function() {
  Route::get('', 'PlanController@create')->name('create');
  foreach([
    "details",
    "attendees",
    "agenda",
    "objectives",
    "summary"
  ] as $step) {
  Route::get($step.'/{meeting}', 'PlanController@'.$step)->name($step);
  }
  Route::put('save/{meeting}', 'PlanController@save')->name('save');
  Route::get('delete/{meeting}', 'PlanController@delete')->name('delete');
  route::get('finish/{meeting}', 'PlanController@finish')->name('finish');
});

Route::prefix('run')->name('run.')->group(function() {
  Route::get('', 'RunController@choose')->name('choose');
  Route::get('{meeting?}', 'RunController@run')->name('run');
});

Route::prefix('ajax')->name('ajax.')->group(function() {
  Route::get('my_meetings', 'AjaxController@meetings')->name('my_meetings');
  Route::get('my_next_steps', 'AjaxController@next_steps')->name('my_next_steps');
  Route::get('my_meetings_run', 'AjaxController@run_choose_meetings')->name('my_meetings_run');

  Route::prefix('plan')->name('plan.')->group(function() {
    Route::get('add_day', 'AjaxController@plan_add_day')->name('add_day');
    Route::get('add_attendee', 'AjaxController@plan_add_attendee')->name('add_attendee');
    Route::get('add_objective', 'AjaxController@plan_add_objective')->name('add_objective');
  });

  Route::prefix('agenda')->name('agenda.')->group(function() {
    Route::post('add_item/{day}/{item_type}', 'AjaxController@plan_add_agenda_item')->name('add_agenda_item');
    Route::delete('delete_item/{item}', 'AjaxController@plan_delete_agenda_item')->name('delete_agenda_item');
    Route::put('move_item/{item_before}/{item_after}', 'AjaxController@plan_move_agenda_item')->name('move_agenda_item');
  });
});
