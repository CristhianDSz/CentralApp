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

//Home
Route::get('/', 'HomeController@index');
//Mandatory areas
Route::get('app/mandatory-areas','MandatoryAreasController@render')->name('mandatory-areas.render');
Route::apiResource('mandatory-areas', 'MandatoryAreasController');
//Subjects
Route::apiResource('subjects','SubjectsController');
//grades
Route::get('app/grades','GradesController@render')->name('grades.render');
Route::apiResource('grades','GradesController');
//Classes
Route::apiResource('classes','ClassesController');
//Schools
Route::resource('schools','SchoolsController')->except(['create','show']);
//Components
Route::get('app/components','ComponentsController@render')->name('components.render');
Route::apiResource('components','ComponentsController');
//Competences
Route::apiResource('competences', 'CompetencesController');
//Indicators
Route::apiResource('indicators','IndicatorsController');
//Ovas
Route::get('app/ovas','OvasController@render')->name('ovas.render');
Route::apiResource('ovas', 'OvasController');
//Learning sections
Route::apiResource('learning-sections','LearningSectionsController');