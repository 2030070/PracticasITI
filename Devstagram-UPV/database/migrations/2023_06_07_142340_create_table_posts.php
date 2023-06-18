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
        Schema::create('Post', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('imagen');
            //agregar el usuario asociado al post de publicaciones: Una relación User -> Posts
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //onDelete (Cascade) si un usuario se elimina se eliminan sus post de publicaciónes


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Post');
    }
};
