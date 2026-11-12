<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();

            // Identidad hondureña: conservar los ceros iniciales
            $table->char('identidad', 13)->unique();

            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('correo', 150)->unique();

            $table->enum('cargo', [
                'ingeniero agronomo',
                'asesor tecnico de campo',
                'jefe de bodega central',
                'operador de maquinaria',
                'cajero',
            ]);

            $table->decimal('salario', 10, 2);
            $table->date('fecha_ingreso');

            $table->enum('estado', [
                'activo',
                'inactivo',
            ])->default('activo');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
