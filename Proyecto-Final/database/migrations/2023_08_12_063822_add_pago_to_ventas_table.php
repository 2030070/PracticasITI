<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPagoToVentasTable extends Migration
{
    public function up()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->decimal('pago', 10, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn('pago');
        });
    }
}
