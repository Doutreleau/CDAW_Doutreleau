<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnergyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
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
        
        Schema::create('tour', function (Blueprint $table) {
            $table->id();
            $table->integer('id_combat');
            $table->integer('length');
            $table->integer('id_type');
            $table->string('poke1Name');
            $table->string('poke2Name');
            $table->integer('poke1Pv');
            $table->integer('poke2Pv');
            
        });

        Schema::create('types_combat', function (Blueprint $table) {
            $table->id();
            $table->string('type');
        });

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

        Schema::create('combat', function (Blueprint $table) {
            $table->id();
            $table->string('mode');
            $table->integer('id_user1');
            $table->integer('id_user2');
        });

        Schema::create('energy_mastered', function (Blueprint $table) {
            $table->id();
            $table->integer('id_energy');
            $table->integer('id_user');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('nb_victories');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('energy', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokemon_table');
        Schema::dropIfExists('tour');
        Schema::dropIfExists('types_combat');
        Schema::dropIfExists('participe');
        Schema::dropIfExists('combat');
        Schema::dropIfExists('energy_mastered');
        Schema::dropIfExists('users');
        Schema::dropIfExists('energy');
       
    }
}