<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToComprasTable extends Migration
{
    public function up()
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->unsignedBigInteger('creado_por');
            $table->foreign('creado_por')->references('id')->on('users');
            $table->decimal('total', 10, 2);
            $table->integer('cantidad');
        });
    }

    public function down()
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->dropForeign(['proveedor_id']);
            $table->dropForeign(['creado_por']);
            $table->dropColumn(['proveedor_id', 'creado_por', 'total', 'cantidad']);
        });
    }
}
