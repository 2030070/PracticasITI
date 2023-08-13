<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromVentasTable extends Migration
{
    public function up()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn('pago_parcial');
            $table->dropColumn('pago_pendiente');
            $table->dropColumn('pago');
            $table->dropColumn('estatus');
        });
    }

    public function down()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->decimal('pago_parcial', 10, 2)->nullable();
            $table->decimal('pago_pendiente', 10, 2)->nullable();
            $table->decimal('pago', 10, 2)->nullable();
            $table->string('estatus')->nullable();
        });
    }
}
