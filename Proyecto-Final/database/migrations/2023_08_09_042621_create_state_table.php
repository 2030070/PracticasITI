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
        Schema::create('state', function (Blueprint $table) {
            $table->increments('state_id');
            $table->string('state_name', 30);
            $table->unsignedInteger('countryid');
            
            // Foreign Key Constraint
            $table->foreign('countryid')->references('id')->on('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('state', function (Blueprint $table) {
            $table->dropForeign(['countryid']);
        });
        Schema::dropIfExists('state');
    }
};
