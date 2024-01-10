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
        Schema::create('fiches', function (Blueprint $table) {
            $table->id('fiche_id');
            $table->string('raison_social');
            $table->string('gerant_nom');
            $table->string('gerant_prenom');
            $table->string('gerant_tel');
            $table->string('gerant_mail');
            $table->enum('genre_gerant', ['female', 'male']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiches');
    }
};
