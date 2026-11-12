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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();

            $table->char('rtn', 14)->unique();
            $table->string('empresa', 255);
            $table->string('contacto', 150);
            $table->char('telefono', 8);

            $table->enum('categorias', [
                'quimicos',
                'semilleros',
                'maquinaria'
            ]);

            $table->decimal('limite_credito', 12, 2)->default(0);
            $table->unsignedSmallInteger('dias_credito')->default(15);

            $table->enum('estado', [
                'activo',
                'inactivo'
            ])->default('activo');

            $table->date('fecha_registro');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
