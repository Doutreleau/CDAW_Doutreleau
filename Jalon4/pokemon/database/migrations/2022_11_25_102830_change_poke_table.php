<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePokeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pokemon_table', function (Blueprint $table) {
            $table->string('energy');
            $table->integer('scoreNormalAttack');
            $table->integer('scoreSpecialAttack');
            $table->integer('scoreSpecialDefense');
            $table->dropColumn('energy_1');
            $table->dropColumn('energy_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pokemon_table', function (Blueprint $table) {
        $table->dropColumn('energy');
        $table->dropColumn('scoreNormalAttack');
        $table->dropColumn('scoreSpecialAttack');
        $table->dropColumn('scoreSpecialDefense');
        $table->string('energy_1');
        $table->string('energy_2');
    });
    }
}