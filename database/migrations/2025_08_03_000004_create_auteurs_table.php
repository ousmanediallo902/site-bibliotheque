<?php

// database/migrations/YYYY_MM_DD_create_auteurs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('auteurs', function (Blueprint $table) {
            $table->id('idAut');
            $table->string('nom_auteur');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('auteurs');
    }
};