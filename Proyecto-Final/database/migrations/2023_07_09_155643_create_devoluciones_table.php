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
        Schema::create('devoluciones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_devolucion');
            $table->string('nombre_producto');
            $table->string('cliente');
            $table->string('estatus');
            $table->decimal('precio_total', 8, 2);
            $table->decimal('pagado', 8, 2);
            $table->decimal('adeudo', 8, 2);
            $table->string('estatus_pago');
            $table->string('creado_por');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devoluciones');
    }
};
