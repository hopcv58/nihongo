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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');
Route::get('/lesson/test', 'LessonController@test')->name('lesson.test');
Route::post('/vocabulary/destroy', 'VocabularyController@destroy')->name('vocabulary.destroy');

Route::resource('vocabulary', 'VocabularyController', ['except' => [
    'destroy'
]]);

Route::resource('lesson', 'LessonController');
Route::resource('class', 'ClassController');
Route::resource('student', 'StudentController');
