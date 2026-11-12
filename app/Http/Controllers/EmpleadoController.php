<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::latest()->paginate(10);
        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Empleado $empleado)
    {
        $request->validate([
            'identidad' => 'nullable|max:13',
            'nombre'      => 'nullable|max:255',
            'cargo' => 'nullable',
            'salario'      => 'nullable|numeric|min:0',
            'fecha_ingreso'       => 'nullable|date',
        ]);

        $empleado->create($request->all());

        return redirect()->route('empleados.index')
                         ->with('success', '¡Empleado creado correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        return view('empleados.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'identidad' => 'nullable|string|max:13',
            'nombre'      => 'nullable|string|max:255',
            'cargo' => 'nullable',
            'salario'      => 'nullable|numeric|min:0',
            'fecha_ingreso'       => 'nullable|date',
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')
                         ->with('success', '¡Empleado actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleados.index')
        ->with('success','Empleado eliminado con exito');
    }
}
