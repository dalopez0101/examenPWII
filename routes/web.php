
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\InsumoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.authenticate');

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    Route::resource('proveedores', ProveedorController::class)
        ->parameters(['proveedores' => 'proveedor']);


    Route::resource('insumos', InsumoController::class);

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::resource('empleados', EmpleadoController::class)
        ->parameters(['empleados' => 'empleado']);

});


