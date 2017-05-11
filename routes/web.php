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

Auth::routes();
//Route::get('/', 'FilesController@index')->name('home');  //指路由名称为home

Route::group(['middleware'=>'auth'],function (){
    Route::get('/', 'FoldersController@index'); //指路由名称为folders
    Route::get('/home', 'FoldersController@index'); //指路由名称为folders
    Route::post('upload/image', 'UploadController@uploadImage'); //上传图片

    Route::get('count', 'CountController@index');
    Route::resource('/folders', 'FoldersController'); //指路由名称为folders
    Route::get('/files/download/{fileid}', 'FilesController@download')->name('files.download');
    Route::post('/files/search/', 'FilesController@search')->name('files.search');
    Route::resource('/files', 'FilesController'); //指路由名称为files
});



