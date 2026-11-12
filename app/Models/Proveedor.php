<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [
        'rtn',
        'empresa',
        'contacto',
        'telefono',
        'categorias',
        'limite_credito',
        'dias_credito',
        'estado',
        'fecha_registro',
    ];

    protected function casts(): array
    {
        return [
            'limite_credito' => 'decimal:2',
            'dias_credito' => 'integer',
            'fecha_registro' => 'date',
        ];
    }
}