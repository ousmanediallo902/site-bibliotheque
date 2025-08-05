<?php

// database/migrations/YYYY_MM_DD_create_ouvrages_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ouvrages', function (Blueprint $table) {
            $table->id('idOuv');
            $table->string('titre');
            $table->foreignId('auteur')->constrained('auteurs', 'idAut');
            $table->string('editeur');
            $table->integer('annee');
            $table->string('domaine');
            $table->integer('stock')->default(0);
            $table->string('site');
            $table->timestamps();

            $table->foreign('site')
                  ->references('nom')
                  ->on('bibliotheques')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ouvrages');
    }
};