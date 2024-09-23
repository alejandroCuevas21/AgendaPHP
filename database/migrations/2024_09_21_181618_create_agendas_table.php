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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->string('Domicilio');
            $table->integer('Numero');
            $table->string('Colonia');
            $table->string('CP');
            $table->string('Ciudad');
            $table->string('Estado');
            $table->integer('Telefono');
            $table->string('Correo');
            $table->decimal('Latitud', 16,4);
            $table->decimal('Longitud', 16,4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
