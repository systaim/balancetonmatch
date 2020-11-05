<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->enum('action',['goal','passeD','nbr_match','yellow_card','red_card'])->nullable();
            $table->unsignedBigInteger('commentaire_id');
            $table->unsignedBigInteger('player_id');
            $table->timestamps();

            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('commentaire_id')->references('id')->on('commentaires');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('statistics');
    }
}
