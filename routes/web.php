
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\InsumoController;

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.authenticate');

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('dashboard',['empresa' => 'AGROVALLE HONDURAS']);
    });

    Route::get('/dashboard', function () {
        return view('dashboard',['empresa' => 'AGROVALLE HONDURAS']);
    })->name('dashboard');


    Route::resource('insumos', InsumoController::class);

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});


