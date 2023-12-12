<?php

use Illuminate\Routing\Route;
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
Volt::route('/posts', 'posts.index');
Volt::route('/posts/create', 'posts.create');
Volt::route('/posts/{post}/edit', 'posts.edit');
Volt::route('/posts/{post}', 'posts.show');
