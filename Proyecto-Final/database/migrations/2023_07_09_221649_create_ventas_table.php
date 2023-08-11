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
            $table->timestamp('fecha_venta');
            $table->unsignedBigInteger('cliente_id');
            $table->string('estatus');
            $table->string('pago');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('descuento', 10, 2);
            $table->decimal('impuestos', 10, 2);
            $table->decimal('total', 10, 2);
            $table->decimal('pago_monto', 10, 2);
            $table->unsignedBigInteger('vendedor_id');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('vendedor_id')->references('id')->on('users');
        
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
