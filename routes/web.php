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

Route::get('/','HomeController@index');
Route::get('/dashboard', 'DashboardController@index');

Route::get('/try','student@index');

Route::resource('student','Data');
Route::post('student/{id}','Data@update');
Route::post('student/{id}/delete' ,'Data@destroy')->name('student.delete');
Route::resource('teacher', 'Teacher_data');
Route::resource('staff', 'StaffController');
Route::get('staffList', 'StaffController@staffList')->name('staffList');
Route::get('store', 'StaffController@store')->name('staff.storer');
Route::get('destroy', 'StaffController@destroy')->name('staffdestroy');
Route::get('edit', 'StaffController@edit')->name('staffedit');
Route::resource('student_ajax','StudentAjaxController');
Route::get('studentlist','StudentAjaxController@studentlist')->name('studentlist');
Route::resource('teacher_ajax','TeacherAjaxController');
Route::get('teacherlist','TeacherAjaxController@teacherlist')->name('teacherlist');
Route::resource('exam','ExamController');
Route::get('tablelist','ExamController@tablelist')->name('tablelist');
Route::resource('profile','ProfileController');
Route::get('password','ProfileController@password')->name('password');
Route::resource('text','TextController');

Auth::routes();
