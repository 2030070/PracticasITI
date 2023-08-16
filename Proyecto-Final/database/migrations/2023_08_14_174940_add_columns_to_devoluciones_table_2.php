<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDevolucionesTable2 extends Migration
{
    public function up()
    {
        Schema::table('devoluciones', function (Blueprint $table) {
            $table->unsignedBigInteger('producto_id')->nullable();
            $table->integer('cantidad')->nullable();
            $table->foreign('producto_id')->references('id')->on('productos');
        });
    }

    public function down()
    {
        Schema::table('devoluciones', function (Blueprint $table) {
            $table->dropForeign(['producto_id']);
            $table->dropColumn('producto_id');
            $table->dropColumn('cantidad');
        });
    }
}
