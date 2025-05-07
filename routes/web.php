<?php

use Illuminate\Support\Facades\Route;
// dd(phpinfo());
Route::get('/', function () {
    return view('welcome');
});
