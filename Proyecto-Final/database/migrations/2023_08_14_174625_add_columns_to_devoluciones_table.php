<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDevolucionesTable extends Migration
{
    public function up()
    {
        Schema::table('devoluciones', function (Blueprint $table) {
            $table->string('descripcion')->nullable();
            $table->unsignedBigInteger('venta_id')->nullable();
            $table->foreign('venta_id')->references('id')->on('ventas');
        });
    }

    public function down()
    {
        Schema::table('devoluciones', function (Blueprint $table) {
            $table->dropForeign(['venta_id']);
            $table->dropColumn('descripcion');
            $table->dropColumn('venta_id');
        });
    }
}
