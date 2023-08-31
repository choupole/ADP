<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nationality_proprietaire', function (Blueprint $table) {
            $table->unsignedBigInteger('nationality_id');
            $table->unsignedBigInteger('proprietaire_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nationality_proprietaire', function (Blueprint $table) {
            $table->foreign('nationality_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreign('proprietaire_id')->references('id')->on('proprietaires')->onDelete('cascade');
        });
    }
};
