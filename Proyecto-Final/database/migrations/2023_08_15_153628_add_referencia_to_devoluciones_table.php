<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferenciaToDevolucionesTable extends Migration
{
    public function up()
    {
        Schema::table('devoluciones', function (Blueprint $table) {
            $table->string('referencia')->nullable();
        });
    }

    public function down()
    {
        Schema::table('devoluciones', function (Blueprint $table) {
            $table->dropColumn('referencia');
        });
    }
}
