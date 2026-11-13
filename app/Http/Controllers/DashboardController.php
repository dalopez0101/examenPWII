<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\Proveedor;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalInsumos = Insumo::count();

        $totalProveedores = Proveedor::where('estado', 'activo')->count();

        $totalEmpleados = Empleado::where('estado', 'activo')->count();

        $valorInventario = Insumo::sum(
            DB::raw('inventario * precio')
        );

        return view('dashboard', compact(
            'totalInsumos',
            'totalProveedores',
            'totalEmpleados',
            'valorInventario'
        ));
    }
}