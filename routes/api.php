<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/search', \App\Http\Controllers\SearchController::class .'@searchByString');
Route::get('/content/{id}', \App\Http\Controllers\ContentController::class .'@getById')->where('id', '[0-9]+');
Route::get('/category/{id}', \App\Http\Controllers\ContentController::class .'@getCategory')->where('id', '[0-9]+');
Route::get('/setting/{key}', \App\Http\Controllers\SettingController::class.'@getByKey');
Route::get('/settings', \App\Http\Controllers\SettingController::class.'@all');
Route::get('/ads', \App\Http\Controllers\AdsController::class.'@all');
Route::get('/jobs', \App\Http\Controllers\JobController::class.'@all');
Route::get('/ward/{id}', \App\Http\Controllers\WardController::class.'@getById')->where('id', '[0-9]+');
