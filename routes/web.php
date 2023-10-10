<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\MailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__ . '/admin.php';

    Route::middleware(['XssSanitizer'])->group(callback: function ()  {

    Route::get('/', [HomePageController::class, 'index'])->name('index');

    Route::get('/post/{post}', [HomePageController::class, 'show'])->name('post.show')->whereNumber('post');

});

Route::get('/log-out', [HomePageController::class, 'logsOut'])->name('logs.outs');

Route::get('send-mail', [MailController::class, 'index']);
