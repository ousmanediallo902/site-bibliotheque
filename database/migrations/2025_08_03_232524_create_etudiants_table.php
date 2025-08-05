<?php

// database/migrations/YYYY_MM_DD_create_etudiants_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id('idEtud');
            $table->string('nom');
            $table->string('adresse');
            $table->string('universite');
            $table->string('specialite');
            $table->integer('nbreEmprunts')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('etudiants');
    }
};