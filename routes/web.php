
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\InsumoController;
use App\Http\Controllers\ProveedorController;

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.authenticate');

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::resource('proveedores', ProveedorController::class)
        ->parameters(['proveedores' => 'proveedor']);


    Route::resource('insumos', InsumoController::class);

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});


