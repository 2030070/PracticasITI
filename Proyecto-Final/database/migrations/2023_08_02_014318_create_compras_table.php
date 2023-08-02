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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_producto');
            $table->string('nombre_proveedor');
            $table->string('referencia');
            $table->date('fecha');
            $table->string('estatus');
            $table->decimal('total', 10, 2);
            $table->decimal('pagado', 10, 2)->nullable();
            $table->decimal('pendiente_de_pago', 10, 2)->nullable();
            $table->string('estatus_de_pago');
            $table->string('creado_por');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
