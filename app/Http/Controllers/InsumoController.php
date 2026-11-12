<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class InsumoController extends Controller
{
    private const CATEGORIAS = [
        'fertilizantes',
        'semillas certificadas',
        'agroquimicos',
        'herramientas',
        'sistemas de riego',
    ];
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Insumo::query();

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;

            $query->where(function ($q) use ($buscar) {
                $q->where('codigo', 'like', "%{$buscar}%")
                ->orWhere('nombre', 'like', "%{$buscar}%")
                ->orWhere('fabricante', 'like', "%{$buscar}%");
            });
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        $insumos = $query->latest()->paginate(10)->withQueryString();

        // Enviar las categorías a la vista
        $categorias = self::CATEGORIAS;

        return view('insumos.index', compact('insumos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = self::CATEGORIAS;

        return view('insumos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => 'required|string|max:50|unique:insumos,codigo',
            'nombre' => 'required|string|max:150',
            'categoria' => ['required', Rule::in(self::CATEGORIAS)],
            'precio' => 'required|numeric|min:0',
            'costo' => 'required|numeric|min:0',
            'inventario' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,png,webp|max:5000',
            'fabricante' => 'nullable|string|max:150',
            'fecha_vencimiento' => 'nullable|date',
            'fecha_registro' => 'required|date',
            'numero_lote' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')
                ->store('insumos', 'public');
        }

        Insumo::create($datos);

        return redirect()
            ->route('insumos.index')
            ->with('success', 'Insumo registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Insumo $insumo)
    {
        return view('insumos.show', compact('insumo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insumo $insumo)
    {
        $categorias = self::CATEGORIAS;

        return view('insumos.edit', compact('insumo', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insumo $insumo)
    {
        $datos = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:50',
                Rule::unique('insumos', 'codigo')->ignore($insumo->id),
            ],
            'nombre' => 'required|string|max:150',
            'categoria' => ['required', Rule::in(self::CATEGORIAS)],
            'precio' => 'required|numeric|min:0',
            'costo' => 'required|numeric|min:0',
            'inventario' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,png,webp|max:2048',
            'fabricante' => 'nullable|string|max:150',
            'fecha_vencimiento' => 'nullable|date',
            'fecha_registro' => 'required|date',
            'numero_lote' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('imagen')) {

            if ($insumo->imagen) {
                Storage::disk('public')->delete($insumo->imagen);
            }

            $datos['imagen'] = $request->file('imagen')
                ->store('insumos', 'public');
        }

        $insumo->update($datos);

        return redirect()
            ->route('insumos.index')
            ->with('success', 'Insumo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insumo $insumo)
    {
        if ($insumo->imagen) {
            Storage::disk('public')->delete($insumo->imagen);
        }

        $insumo->delete();

        return redirect()
            ->route('insumos.index')
            ->with('success', 'Insumo eliminado correctamente.');
    }
}
