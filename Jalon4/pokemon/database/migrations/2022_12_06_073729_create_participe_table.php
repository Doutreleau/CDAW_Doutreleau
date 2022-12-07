<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipeTable extends Migration
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
            $table->integer('id_pokemon1');
            $table->integer('id_pokemon2');
            $table->integer('id_pokemon3');
            $table->integer('id_pokemon4');
            $table->integer('id_pokemon5');
            $table->integer('id_pokemon6');
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