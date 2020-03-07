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

// Non-Logged in users API's
Route::prefix('v1')->attribute('namespace', 'Api')->group(function () {
    Route::post('/active', ['uses' => 'ActiveModelController@active', 'as' => 'api.model.active']);
    Route::get('/roles', ['uses' => 'RoleController@index', 'as' => 'api.roles.index']);
    Route::get('/locations', ['uses' => 'LocationsController@index', 'as' => 'api.locations']);
    Route::post('/seeker/email/update/{seeker}', ['uses' => 'SeekerController@changeEmail', 'as' => 'api.seeker.change.email']);
    Route::post('/seeker/password/update/{seeker}', ['uses' => 'SeekerController@changePassword', 'as' => 'api.seeker.change.password']);
//    Route::post('/active_notification', ['uses' => 'SeekerController@active', 'as' => 'api.model.active.notification']);
});
