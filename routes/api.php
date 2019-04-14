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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::get('books', 'BookController@index');
    Route::post('books', 'BookController@store');
    Route::get('books/{book}', 'BookController@show');
    Route::put('books/{book}', 'BookController@update');
    Route::delete('books/{book}', 'BookController@destroy');

    Route::get('categories', 'CategoryController@index');
    Route::post('categories', 'CategoryController@store');
    Route::get('categories/{category}', 'CategoryController@show');
    Route::put('categories/{category}', 'CategoryController@update');
    Route::delete('categories/{category}', 'CategoryController@destroy');
});

Route::fallback(function () {
    return response()->json(['message' => 'Not Found.'], 404);
});
