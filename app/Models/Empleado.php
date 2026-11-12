<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $fillable = [
        'identidad',
        'nombre',
        'apellido',
        'correo',
        'cargo',
        'salario',
        'fecha_ingreso',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'salario' => 'decimal:2',
            'fecha_ingreso' => 'date',
        ];
    }
}