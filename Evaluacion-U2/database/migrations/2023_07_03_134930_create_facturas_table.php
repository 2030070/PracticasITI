<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->string('folio_factura');
            $table->string('pdf_file');
            $table->string('xml_file');
            $table->timestamps(); 

            $table->foreignId('empresa_emisora_id')->constrainted('empresas_emisoras');
            $table->foreignId('empresa_receptora_id')->constrainted('empresas_receptoras');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
