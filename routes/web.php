<?php

use App\Livewire\Pages\Auth\Login;
use App\Models\User;
use Illuminate\Support\Facades\Route;

use App\Livewire\Pages\Main\Home;
use Illuminate\Support\Facades\Auth;

Route::get('/',Home::class)->name('home');

// Auth Routes
Route::get('/login',Login::class)->name('login');
Route::any('/logout',[Login::class,'logout'])->name('logout');


