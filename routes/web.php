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
Route::get('app/mandatory-areas/all','MandatoryAreasController@mandatoryAreas');
Route::apiResource('mandatory-areas', 'MandatoryAreasController');
//Subjects
Route::apiResource('subjects','SubjectsController');
Route::get('app/subjects/all','SubjectsController@subjects');
//grades
Route::get('app/grades','GradesController@render')->name('grades.render');
Route::get('app/grades/all', 'GradesController@grades');
Route::apiResource('grades','GradesController');
//Classes
Route::apiResource('classes','ClassesController');
Route::get('app/classes/all','ClassesController@classes');
//Schools
Route::resource('schools','SchoolsController')->except(['create','show']);
//Components
Route::get('app/components','ComponentsController@render')->name('components.render');
Route::get('app/components/all','ComponentsController@components');
Route::apiResource('components','ComponentsController');
//Competences
Route::apiResource('competences', 'CompetencesController');
//Indicators
Route::apiResource('indicators','IndicatorsController');
//Ovas
Route::get('app/ovas','OvasController@render')->name('ovas.render');
Route::get('app/ovas/pdf/{id}','OvasController@pdf');
Route::post('app/ovas/images/{id}', 'OvasController@storeImage');
Route::apiResource('ovas', 'OvasController');
Route::get('ovas/{ova}/components', 'OvasController@components');
//Learning sections
Route::apiResource('learning-sections','LearningSectionsController');
//Resources
Route::post('/resources','ResourcesController@store');
Route::delete('/resources/{resource}', 'ResourcesController@destroy');
//Bibliographies
Route::post('/bibliographies','BibliographiesController@store');
Route::delete('/bibliographies/{bibliography}','BibliographiesController@destroy');
//Homeworks
Route::post('/homeworks','HomeworksController@store');
Route::delete('/homeworks/{homework}','HomeworksController@destroy');
//Users Authentication and Registration
Route::namespace('Auth')->group(function () {
    //Authentication
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
    //Registration
    Route::get('register','RegisterController@showRegistrationForm')->name('register');
    Route::post('register','RegisterController@register');
});
//Permissions
Route::get('permissions', 'PermissionsController@index')->name('permissions.index');
//Roles
Route::resource('roles','RolesController')->except(['show']);
//Users
Route::resource('users','UsersController')->except(['show','create']);
Route::get('users/passwords','UsersController@editPassword')->name('passwords.index');
Route::patch('users/passwords/{user}','UsersController@password')->name('passwords.update');
//Manuals
Route::resource('manuals', 'ManualsController')->except(['show']);
//Presentations
Route::get('app/paremeters', 'PresentationsController@render')->name('parameters.render');
Route::get('app/presentations/all', 'PresentationsController@presentations');
Route::apiResource('presentations', 'PresentationsController');



