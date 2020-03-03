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
    Route::apiResource('company', 'CompanyController');
    Route::apiResource('meeting', 'MeetingController');
    Route::apiResource('agendaitem', 'AgendaItemController');
    Route::apiResource('attendee', 'AttendeeController');
    Route::apiResource('benefit', 'BenefitController');
    Route::apiResource('concern', 'ConcernController');
    Route::apiResource('day', 'DayController');
    Route::apiResource('decision', 'DecisionController');
    Route::apiResource('expectation', 'ExpectationController');
    Route::apiResource('nextstep', 'NextStepController');
    Route::apiResource('note', 'NoteController');
    Route::apiResource('objective', 'ObjectiveController');
    Route::apiResource('token', 'TokenController');
     */
});
