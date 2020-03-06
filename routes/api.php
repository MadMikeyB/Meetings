<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace("Api")->name("api.")->group(function() {
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    })->name('user');
    /*
    Route::apiResources([
      'company' => 'CompanyController',
      'meeting' => 'MeetingController',
      'agendaitem' => 'AgendaItemController',
      'benefit' => 'BenefitController',
      'concern' => 'ConcernController',
      'day' => 'DayController',
      'decision' => 'DecisionController',
      'expectation' => 'ExpectationController',
      'nextstep' => 'NextStepController',
      'note' => 'NoteController',
      'objective' => 'ObjectiveController',
      'token' => 'TokenController',
    ]);
     */
});
