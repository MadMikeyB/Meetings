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
  return redirect('home');
});

Auth::routes();

Route::get('dashboard', 'HomeController@index')->name('home');
Route::get('meetings', 'HomeController@indexMeetings')->name('meetings');
Route::get('next_steps', 'HomeController@indexNextSteps')->name('next_steps');


Route::get('plan', 'HomeController@planNewMeeting')->name('plan_new_meeting');
Route::get('plan/{meeting}', 'HomeController@editMeeting')->name('edit_meeting');

Route::get('plan', 'MeetingController@newPlan');

Route::prefix('ajax')->group(function() {
  Route::get('my_meetings', 'AjaxController@meetings');
  Route::get('my_next_steps', 'AjaxController@next_steps');
});
