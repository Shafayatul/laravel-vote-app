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

Route::get('/myform', function () {
    return view('myform');
});

Route::get('/project-insert', function () {
    return view('project-insert');
});

Route::get('/project-show', function () {
    return view('project-show');
});

Route::get('/project-bewerten', function () {
    return view('project-bewerten');
});

Route::get('/project-freigeben', function () {
    return view('project-freigeben');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/downlaod/my-invoice', 'ProjectController@my_pdf_download');
Route::get('/downlaod/pdf/{id}', 'ProjectController@pdf_download');
Route::post('/register-new-user', 'ProjectController@registerNewUser');
Route::get('/invoice', 'ProjectController@invoice');
Route::get('/project/top-five', 'ProjectController@TopFive');
Route::get('/project/single/admin/{id}', 'ProjectController@SingleProject');
Route::get('/project/add-image/{project_id}/{cat_id}', 'ProjectController@AddImage');
Route::get('/project/edit-image/{project_id}/{cat_id}', 'ProjectController@EditImage');
Route::post('/project/delete-image', 'ProjectController@DeleteImage');
Route::get('/project-show-rater', 'ProjectController@ProjectBewerten')->name('project-show-rater');
Route::get('/project-freigeben', 'ProjectController@ProjectFreigeben')->name('project-freigeben');
Route::get('/admin-project-show/{project_stat_id}', 'ProjectController@adminProjectShow');
Route::get('/project-show', 'ProjectController@ProjectShow')->name('project-show');
Route::post('/change-project', 'ProjectController@ProjectChange')->name('change-project');
Route::post('/project-rated', 'ProjectController@ProjectRated')->name('project-rated');
Route::post('/email-senden', 'ProjectController@EmailSenden')->name('email-senden');
Route::post('/project-freigegeben', 'ProjectController@ProjectFreigegeben')->name('project-freigegeben');

Route::get('/user-change', 'HomeController@change')->name('user-change');
Route::post('user-change', 'ChangeController@change');
Route::post('project-insert', 'ProjectController@insertProjectStepOne');
Route::post('/invoice-paid', 'InvoicesController@invoicePaid');
Route::post('/project-accept-admin', 'ProjectController@acceptProject');
Route::post('/project-reject-admin', 'ProjectController@rejectProject');
Route::post('/project-delete-admin', 'ProjectController@deleteProject');
Route::post('/project-jury-admin', 'ProjectController@juryProject');
Route::post('project-change', 'ProjectController@changeProject')->name('project-change');
Route::post('/add-project', 'ProjectController@insertProject')->name('add-project');
Route::post('/images-save', 'ProjectController@upload')->name('/images-save');
Route::post('/images-delete', 'ProjectController@delete')->name('/images-delete');
Route::post('/show-delete', 'ProjectController@show_delete')->name('/show-delete');
Route::post('send-email', 'ProjectController@send-email')->name('send-email');

Route::post('next-view', 'ProjectController@insertProjectStepTwo')->name('next-view');

Route::post('filter', 'ProjectController@filter');
Route::get('project-insert', 'ProjectController@myform')->name('project-insert');
