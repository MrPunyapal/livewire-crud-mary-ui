<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Posts;

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

Route::redirect('/', '/posts');


Route::name('posts.')->prefix('posts')->group(function () {
    Route::get('/', Posts\Index::class)->name('index');
    // Route::get('/create', Posts\Create::class)->name('create');
    // Route::get('/{post}/edit', Posts\Edit::class)->name('edit');
    // Route::get('/{post}', Posts\Show::class)->name('show');
});

Route::name('volt.posts.')->prefix('volt/posts')->group(function () {
    Volt::route('/', 'volt.posts.index')->name('index');
    Volt::route('/create', 'volt.posts.create')->name('create');
    Volt::route('/{post}/edit', 'volt.posts.edit')->name('edit');
    Volt::route('/{post}', 'volt.posts.show')->name('show');
});
