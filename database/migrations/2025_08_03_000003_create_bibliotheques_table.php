<?php

// database/migrations/YYYY_MM_DD_create_bibliotheques_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bibliotheques', function (Blueprint $table) {
            $table->string('nom')->primary();
            $table->string('universite');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bibliotheques');
    }
};