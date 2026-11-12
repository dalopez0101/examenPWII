<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'insumos';

    protected $fillable = [
        'codigo',
        'nombre',
        'categoria',
        'precio',
        'costo',
        'inventario',
        'imagen',
        'fabricante',
        'fecha_vencimiento',
        'fecha_registro',
        'numero_lote',
    ];

    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
            'costo' => 'decimal:2',
            'inventario' => 'integer',
            'fecha_vencimiento' => 'date',
            'fecha_registro' => 'date',
        ];
    }
}
