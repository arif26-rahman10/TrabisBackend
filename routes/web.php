<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home'); // arahkan ke home.blade.php
});