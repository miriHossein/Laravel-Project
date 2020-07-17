<?php

use Illuminate\Support\Facades\Route;

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

Route::auth();



Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function () {

    Route::resource('/admin/users', 'AdminUserController');
    Route::resource('/admin/roles', 'AdminRoleController');
    Route::resource('/admin/posts', 'AdminPostController');
    Route::resource('/admin/categories', 'AdminCategoryController');
    Route::resource('/admin/medias', 'AdminMediaController');
    Route::resource('/admin/comments', 'PostCommentsController');
    Route::resource('/admin/replies', 'CommentRepliesController');
    Route::post('comment/reply', 'CommentRepliesController@createReply');

});


Route::get('/admin', function() {
    return view('admin.index');
})->name('dashboard')->middleware('auth');


