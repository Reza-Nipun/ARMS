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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'ApiController@index');
Route::get('document_list', 'ApiController@documentList');
Route::get('units', 'ApiController@getUnits');
Route::get('departments', 'ApiController@getDepartments');
Route::get('service_types', 'ApiController@getServiceTypes');
Route::get('get_documents', 'ApiController@getDocuments');