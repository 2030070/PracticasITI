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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('imagen');

            //agregamos el usuario asociado al post de publucacion; una relacion User- Post 
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //onDelete('cascade') sigifica que si un suuario se elimina, se eliminen sus posts de publicaciones
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
