<?php

use Illuminate\Support\Facades\Route;
use App\Mail\ReminderMail;

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

//Route::get('/', function () {
//    return view('auth.login');
//});

Route::get('/', 'Auth\LoginController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController');

Route::resource('units', 'UnitsController');

Route::resource('departments', 'DepartmentsController');

Route::resource('service_types', 'ServiceTypesController');

Route::resource('documents', 'DocumentsController');

Route::get('/getDocuments', 'DocumentsController@getDocuments');

Route::get('/documentList', 'DashboardController@index')->name('dashboard');

Route::get('/filterDocuments', 'DashboardController@getFilteredDocuments')->name('filterDocuments');

Route::get('/renewReminderMail', 'DashboardController@renewReminderMail');

Route::get('/reminderEmail', function () {
    return new ReminderMail();
});