<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Admin controllers
use App\Http\Controllers\Admin\Post\IndexController as AdminPostIndexController;

Route::group(['namespace' => 'App\Http\Controllers\Post'], function () {
    Route::get('/posts', 'IndexController')->name('post.index');
    Route::get('/posts/create', 'CreateController')->name('post.create');

    Route::post('/posts', 'StoreController')->name('post.store');
    Route::get('/posts/{post}', 'ShowController')->name('post.show');
    Route::get('/posts/{post}/edit', 'EditController')->name('post.edit');
    Route::patch('/posts/{post}', 'UpdateController')->name('post.update');
    Route::delete('/posts/{post}', 'DestroyController')->name('post.delete');
});

// Главная
Route::get('/', [HomeController::class, 'index']);

// Route::middleware('auth', 'admin')->group([
//     'prefix' => 'admin',
//     'namespace' => 'App\Http\Controllers\Admin',
// ], function () {
//     Route::group(['namespace' => 'Post'], function () {
//         Route::get('/post', 'IndexController')
//             ->name('admin.post.index');
//     });
// });

Route::middleware([\App\Http\Middleware\AdminPanelMiddleware::class])
    ->prefix('admin')
    ->group(function () {
        Route::get('/post', [\App\Http\Controllers\Admin\Post\IndexController::class, 'index'])
            ->name('admin.post.index');
    });


Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
