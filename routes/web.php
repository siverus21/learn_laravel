<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'App\Http\Controllers\Post'], function () {
    Route::get('/posts', 'IndexController')->name('post.index');
    Route::get('/posts/create', 'CreateController')->name('post.create');

    Route::post('/posts', 'StoreController')->name('post.store');
    Route::get('/posts/{post}', 'ShowController')->name('post.show');
    Route::get('/posts/{post}/edit', 'EditController')->name('post.edit');
    Route::patch('/posts/{post}', 'UpdateController')->name('post.update');
    Route::delete('/posts/{post}', 'DestroyController')->name('post.delete');
});

Route::group(
    ['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin'],
    function () {

        Route::group(['namespace' => 'Post'], function () {
            Route::get('/post', 'IndexController')->name('admin.post.index');
        });
    }
);


// Route::get('/posts/update', [PostController::class, 'update']);
// Route::get('/posts/delete', [PostController::class, 'delete']);
// Route::get('/posts/first_or_create', [PostController::class, 'firstOrCreate']);
// Route::get('/posts/update_or_create', [PostController::class, 'updateOrCreate']);

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
