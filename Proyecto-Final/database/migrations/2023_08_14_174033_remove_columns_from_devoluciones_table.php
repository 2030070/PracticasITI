<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromDevolucionesTable extends Migration
{
    public function up()
    {
        Schema::table('devoluciones', function (Blueprint $table) {
            $table->dropColumn('nombre_producto');
            $table->dropColumn('cliente');
            $table->dropColumn('estatus');
            $table->dropColumn('precio_total');
            $table->dropColumn('pagado');
            $table->dropColumn('adeudo');
            $table->dropColumn('estatus_pago');
        });
    }

    public function down()
    {

    }
}
