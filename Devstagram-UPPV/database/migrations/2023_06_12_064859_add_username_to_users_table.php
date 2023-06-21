<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //agregar campo a la tabla de usuarios
            //$table-> string('username');
            //agregar campo a la tabla de usaurios
            $table-> string('username')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //eliminar usrname de columna usuarios
            $table->dropColumn('username');
        });
    }
};
