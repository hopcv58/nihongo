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
Route::post('/lesson/destroy', 'LessonController@destroy')->name('lesson.destroy');
Route::post('/class/destroy', 'ClassController@destroy')->name('class.destroy');
Route::post('/student/destroy', 'StudentController@destroy')->name('student.destroy');

Route::resource('vocabulary', 'VocabularyController', ['except' => [
    'destroy'
]]);

Route::resource('lesson', 'LessonController', ['except' => [
    'destroy'
]]);
Route::resource('class', 'ClassController', ['except' => [
    'destroy'
]]);
Route::resource('student', 'StudentController', ['except' => [
    'destroy'
]]);
