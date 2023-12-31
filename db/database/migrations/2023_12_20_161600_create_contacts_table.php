<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id('contact_id')->index();
            $table->unsignedBigInteger('personne_id')->index(); // Make sure it's unsigned
            $table->enum('fonction', ['gerant', 'technicien', 'moderateur', 'commercial', 'directeur', 'autre'])->index();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('personne_id')->references('personne_id')->on('personnes')->onDelete('cascade');
            // $table->foreign('personne_id')->references('personne_id')->on('personnes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contacts');
    }
};
