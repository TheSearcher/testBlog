<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\User\PostController as UserPostController;
use App\Http\Controllers\User\CommentController as userCommentController;



/*
|--------------------------------------------------------------------------
| Web Routes for admin panel
|--------------------------------------------------------------------------
|
*/

//Route::prefix('admin')->middleware(['auth','XssSanitizer'])->name('admin.')->group(callback: function ()  {

Route::prefix('dashboard')->middleware(['auth'])->name('dashboard.')->group(callback: function ()  {

    Route::get('/', function () {
        return view('dashboard.admin.index');
    })->name('dashboard');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('post', PostController::class)->except(['show','create','store','edit','update']);
        Route::resource('comment', CommentController::class)->except(['show','create','store','edit','update']);
    });

 //   Route::prefix('user')->middleware(['role:authenticated-user-can-access'])->name('user.')->group(callback: function () {
/*    Route::group(['middleware' => ['role:admin']], function () {
    */

    Route::prefix('user')->name('user.')->group(function () {
    Route::group(['middleware' => ['permission:authenticated-user-can-access']], function () {
        //


        Route::get('/', function () {
            return view('dashboard.auth-user.index');
        })->name('dashboard');

        Route::resource('post', UserPostController::class)->except(['show']);
        Route::resource('comment', userCommentController::class)->except(['show','create']);
        Route::get('/post/{post}', [UserPostController::class, 'edit'])->name('post.edit')->whereNumber('post');
        Route::get('/comment/{comment}', [userCommentController::class, 'edit'])->name('comment.edit')->whereNumber('comment');
    });
    });
});

