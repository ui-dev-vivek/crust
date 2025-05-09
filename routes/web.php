<?php

use App\Livewire\Pages\Auth\Login;
use App\Models\User;
use Illuminate\Support\Facades\Route;
// dd(phpinfo());
Route::get('/', function () {
    return view('welcome');
});



// Auth Routes
Route::get('/login',Login::class)->name('login');
Route::any('/logout',[Login::class,'logout'])->name('logout');


