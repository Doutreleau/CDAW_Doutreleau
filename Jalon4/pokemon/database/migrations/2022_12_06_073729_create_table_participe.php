<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableParticipe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participe', function (Blueprint $table) {
            $table->id();
            $table->integer('id_combat');
            $table->integer('id_pokemon11');
            $table->integer('id_pokemon12');
            $table->integer('id_pokemon13');
            $table->integer('id_pokemon21');
            $table->integer('id_pokemon22');
            $table->integer('id_pokemon23');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participe');
    }
}