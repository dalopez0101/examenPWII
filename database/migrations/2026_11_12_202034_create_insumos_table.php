<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('insumos', function (Blueprint $table) {

            $table->id();
            $table->string('codigo', 50)->unique();
            $table->string('nombre', 150);
            $table->string('categoria', 50);
            $table->decimal('precio', 10, 2);
            $table->decimal('costo', 10, 2);
            $table->unsignedInteger('inventario')->default(0);
            $table->string('imagen')->nullable();
            $table->string('fabricante', 150)->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->date('fecha_registro');
            $table->string('numero_lote', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('insumos');
    }
};
