<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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

// TODO: resourceful routes?

Route::group(['prefix' => 'volt/posts'], function () {
    Volt::route('/', 'posts.index');
    Volt::route('/create', 'posts.create');
    Volt::route('/{post}/edit', 'posts.edit');
    Volt::route('/{post}', 'posts.show');
});
