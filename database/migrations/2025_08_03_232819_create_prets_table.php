<?php

// database/migrations/YYYY_MM_DD_create_prets_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ouvg')->constrained('ouvrages', 'idOuv');
            $table->foreignId('etud')->constrained('etudiants', 'idEtud');
            $table->dateTime('date_emprunt');
            $table->dateTime('date_retour')->nullable();
            $table->timestamps();

            $table->unique(['ouvg', 'etud', 'date_emprunt']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('prets');
    }
};