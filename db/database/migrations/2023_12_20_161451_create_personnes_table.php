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
        Schema::create('personnes', function (Blueprint $table) {

            $table->id('personne_id');
            $table->string('firstName')->index();
            $table->string('lastname')->index();
            $table->enum('genre', ['female', 'male'])->index();
            $table->string('email')->index();
            $table->string('phonenumber')->index();
            $table->string('avatar');

            $table->softDeletes()->nullable();
            $table->timestamps(); // This will create created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('personnes');
    }
};
