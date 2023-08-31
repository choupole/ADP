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
        Schema::create('proprietaires', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique()->primary(); // désactiver l'auto-incrémentation pour le champ "id"
            $table->string('nom');
            $table->string('postnom');
            $table->string('prenom');
            $table->string('sexe');
            $table->string('numeroPar');
            $table->string('avenue');
            $table->string('quartier');
            $table->string('commune');
            $table->timestamps();
            $table->softDeletes(); // ajouter une colonne "deleted_at" pour le SoftDeletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proprietaires');
    }
};
