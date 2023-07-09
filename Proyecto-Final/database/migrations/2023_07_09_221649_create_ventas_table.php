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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('nombre_cliente');
            $table->string('referencia');
            $table->string('estatus');
            $table->string('pago')->default('pendiente');
            $table->decimal('total', 10, 2);
            $table->decimal('pago_parcial', 10, 2)->nullable();
            $table->decimal('pago_pendiente', 10, 2)->nullable();
            $table->string('creado_por');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
