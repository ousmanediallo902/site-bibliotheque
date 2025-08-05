<?php

// database/migrations/YYYY_MM_DD_create_employes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id('idEmp');
            $table->string('nom');
            $table->string('adresse');
            $table->string('statut');
            $table->string('bibliotheque');
            $table->timestamps();

            $table->foreign('bibliotheque')
                  ->references('nom')
                  ->on('bibliotheques')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employes');
    }
};