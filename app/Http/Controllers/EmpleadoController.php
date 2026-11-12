<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmpleadoController extends Controller
{
    private const CARGOS = [
        'ingeniero agronomo',
        'asesor tecnico de campo',
        'jefe de bodega central',
        'operador de maquinaria',
        'cajero',
    ];

    private const ESTADOS = [
        'activo',
        'inactivo',
    ];

    public function index(Request $request)
    {
        $query = Empleado::query();

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;

            $query->where(function ($q) use ($buscar) {
                $q->where('identidad', 'like', "%{$buscar}%")
                    ->orWhere('nombre', 'like', "%{$buscar}%")
                    ->orWhere('apellido', 'like', "%{$buscar}%")
                    ->orWhere('correo', 'like', "%{$buscar}%");
            });
        }

        if ($request->filled('cargo')) {
            $query->where('cargo', $request->cargo);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $empleados = $query
            ->orderBy('apellido')
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        $cargos = self::CARGOS;

        return view('empleados.index', compact(
            'empleados',
            'cargos'
        ));
    }

    public function create()
    {
        $cargos = self::CARGOS;

        return view('empleados.create', compact('cargos'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'identidad' => [
                'required',
                'string',
                'size:13',
                'regex:/^[0-9]{13}$/',
                'unique:empleados,identidad',
            ],

            'nombre' => [
                'required',
                'string',
                'max:100',
            ],

            'apellido' => [
                'required',
                'string',
                'max:100',
            ],

            'correo' => [
                'required',
                'email',
                'max:150',
                'unique:empleados,correo',
            ],

            'cargo' => [
                'required',
                Rule::in(self::CARGOS),
            ],

            'salario' => [
                'required',
                'numeric',
                'gt:0',
                'max:99999999.99',
                'decimal:0,2',
            ],

            'fecha_ingreso' => [
                'required',
                'date_format:Y-m-d',
            ],

            'estado' => [
                'required',
                Rule::in(self::ESTADOS),
            ],
        ], [
            'identidad.required' => 'La identidad es obligatoria.',
            'identidad.size' => 'La identidad debe contener exactamente 13 dígitos.',
            'identidad.regex' => 'La identidad debe contener únicamente números, sin guiones.',
            'identidad.unique' => 'Esta identidad ya está registrada.',

            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Ingresa un correo electrónico válido.',
            'correo.unique' => 'Este correo ya está registrado.',

            'cargo.required' => 'Debes seleccionar un cargo.',
            'cargo.in' => 'El cargo seleccionado no es válido.',

            'salario.gt' => 'El salario debe ser mayor que cero.',
            'salario.max' => 'El salario supera el máximo permitido.',
            'salario.decimal' => 'El salario admite máximo 2 decimales.',

            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
            'fecha_ingreso.date_format' => 'La fecha de ingreso no tiene un formato válido.',
        ]);

        Empleado::create($datos);

        return redirect()
            ->route('empleados.index')
            ->with('success', 'Empleado registrado correctamente.');
    }

    public function show(Empleado $empleado)
    {
        return view('empleados.show', compact('empleado'));
    }

    public function edit(Empleado $empleado)
    {
        $cargos = self::CARGOS;

        return view('empleados.edit', compact(
            'empleado',
            'cargos'
        ));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $datos = $request->validate([
            'identidad' => [
                'required',
                'string',
                'size:13',
                'regex:/^[0-9]{13}$/',
                Rule::unique('empleados', 'identidad')->ignore($empleado->id),
            ],

            'nombre' => [
                'required',
                'string',
                'max:100',
            ],

            'apellido' => [
                'required',
                'string',
                'max:100',
            ],

            'correo' => [
                'required',
                'email',
                'max:150',
                Rule::unique('empleados', 'correo')->ignore($empleado->id),
            ],

            'cargo' => [
                'required',
                Rule::in(self::CARGOS),
            ],

            'salario' => [
                'required',
                'numeric',
                'gt:0',
                'max:99999999.99',
                'decimal:0,2',
            ],

            'fecha_ingreso' => [
                'required',
                'date_format:Y-m-d',
            ],

            'estado' => [
                'required',
                Rule::in(self::ESTADOS),
            ],
        ]);

        $empleado->update($datos);

        return redirect()
            ->route('empleados.index')
            ->with('success', 'Información del empleado actualizada correctamente.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()
            ->route('empleados.index')
            ->with('success', 'Empleado eliminado correctamente.');
    }
}