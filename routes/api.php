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

Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('project', 'ProjectController');
    Route::apiResource('issue', 'IssueController');
    Route::get('project/mine', 'ProjectController@myProjects');
    Route::get('me', 'MeController@index');
});