<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller
{
    private const CATEGORIAS = [
        'quimicos',
        'semilleros',
        'maquinaria',
    ];

    private const DIAS_CREDITO = [15, 30, 45, 60];

    private const ESTADOS = [
        'activo',
        'inactivo',
    ];


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Proveedor::query();

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;

            $query->where(function ($q) use ($buscar) {
                $q->where('rtn', 'like', "%{$buscar}%")
                    ->orWhere('empresa', 'like', "%{$buscar}%")
                    ->orWhere('contacto', 'like', "%{$buscar}%");
            });
        }

        if ($request->filled('categoria')) {
            $query->where('categorias', $request->categoria);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $proveedores = $query
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        $categorias = self::CATEGORIAS;

        return view('proveedores.index', compact(
            'proveedores',
            'categorias'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = self::CATEGORIAS;
        $diasCredito = self::DIAS_CREDITO;

        return view('proveedores.create', compact(
            'categorias',
            'diasCredito'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'rtn' => [
                'required',
                'string',
                'size:14',
                'regex:/^[0-9]{14}$/',
                'unique:proveedores,rtn',
            ],

            'empresa' => [
                'required',
                'string',
                'max:255',
            ],

            'contacto' => [
                'required',
                'string',
                'max:150',
            ],

            'telefono' => [
                'required',
                'string',
                'size:8',
                'regex:/^[0-9]{8}$/',
            ],

            'categorias' => [
                'required',
                Rule::in(self::CATEGORIAS),
            ],

            'limite_credito' => [
                'required',
                'numeric',
                'min:0',
                'max:9999999999.99',
                'decimal:0,2',
            ],

            'dias_credito' => [
                'required',
                'integer',
                Rule::in(self::DIAS_CREDITO),
            ],

            'estado' => [
                'required',
                Rule::in(self::ESTADOS),
            ],

            'fecha_registro' => [
                'required',
                'date_format:Y-m-d',
            ],
        ], [
            'rtn.required' => 'El RTN es obligatorio.',
            'rtn.size' => 'El RTN debe contener exactamente 14 dígitos.',
            'rtn.regex' => 'El RTN solamente debe contener números.',
            'rtn.unique' => 'Este RTN ya está registrado.',

            'telefono.size' => 'El teléfono debe contener 8 dígitos.',
            'telefono.regex' => 'El teléfono solamente debe contener números.',

            'limite_credito.numeric' => 'El límite de crédito debe ser numérico.',
            'limite_credito.min' => 'El límite de crédito no puede ser negativo.',
            'limite_credito.decimal' => 'El crédito admite máximo 2 decimales.',

            'dias_credito.in' => 'Selecciona un plazo de crédito válido.',
            'fecha_registro.date_format' => 'La fecha de registro no es válida.',
        ]);

        Proveedor::create($datos);

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        return view('proveedores.show', compact('proveedor'));
    }

    /**
     * Show the form for edit the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        $categorias = self::CATEGORIAS;
        $diasCredito = self::DIAS_CREDITO;

        return view('proveedores.edit', compact(
            'proveedor',
            'categorias',
            'diasCredito'
        ));
    }

    /**
     * Show the form for update the specified resource.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $datos = $request->validate([
            'rtn' => [
                'required',
                'string',
                'size:14',
                'regex:/^[0-9]{14}$/',
                Rule::unique('proveedores', 'rtn')->ignore($proveedor->id),
            ],

            'empresa' => ['required', 'string', 'max:255'],
            'contacto' => ['required', 'string', 'max:150'],

            'telefono' => [
                'required',
                'string',
                'size:8',
                'regex:/^[0-9]{8}$/',
            ],

            'categorias' => [
                'required',
                Rule::in(self::CATEGORIAS),
            ],

            'limite_credito' => [
                'required',
                'numeric',
                'min:0',
                'max:9999999999.99',
                'decimal:0,2',
            ],

            'dias_credito' => [
                'required',
                'integer',
                Rule::in(self::DIAS_CREDITO),
            ],

            'estado' => [
                'required',
                Rule::in(self::ESTADOS),
            ],

            'fecha_registro' => [
                'required',
                'date_format:Y-m-d',
            ],
        ]);

        $proveedor->update($datos);

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente.');
    }
    /**
     * Remove the specified resource in storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor eliminado correctamente.');
    }
}