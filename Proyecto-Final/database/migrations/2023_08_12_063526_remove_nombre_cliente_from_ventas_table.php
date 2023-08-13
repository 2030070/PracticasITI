<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveNombreClienteFromVentasTable extends Migration
{
    public function up()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn('nombre_cliente');
        });
    }

    public function down()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->string('nombre_cliente')->nullable();
        });
    }
}
