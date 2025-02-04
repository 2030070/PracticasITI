<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCreadoPorFromVentasTable extends Migration
{
    public function up()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn('creado_por');
        });
    }

    public function down()
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->unsignedBigInteger('creado_por')->nullable();
        });
    }
}
