<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard', ['empresa' => 'AGROVALLE HONDURAS']);
})->name('dashboard');
