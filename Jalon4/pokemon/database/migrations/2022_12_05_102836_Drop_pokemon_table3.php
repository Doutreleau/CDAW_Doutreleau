<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPokemonTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pokemon_table');
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('pokemon_table', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name');
            $table->integer('energy');
            $table->integer('pv_max');
            $table->integer('level');
            $table->string('path');
            $table->integer('scoreNormalAttack');
            $table->integer('scoreSpecialAttack');
            $table->integer('scoreSpecialDefense');
            $table->timestamps();
        });
       
    }
}