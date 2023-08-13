<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('ventas_productos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('venta_id');
        $table->unsignedBigInteger('producto_id');
        $table->integer('cantidad');
        $table->timestamps();

        // Definir las claves foráneas
        $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');
        $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('ventas_productos');
}
};
