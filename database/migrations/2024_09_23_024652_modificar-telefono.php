<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->string('Telefono', 15)->change();
        });
    }

    public function down()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->integer('Telefono')->change(); // Ajusta el tipo original según corresponda
        });
    }
};
