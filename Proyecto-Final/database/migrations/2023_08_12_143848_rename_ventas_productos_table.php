<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameVentasProductosTable extends Migration
{
    public function up()
    {
        Schema::rename('ventas_productos', 'producto_venta');
    }

    public function down()
    {
        Schema::rename('producto_venta', 'ventas_productos');
    }
}
