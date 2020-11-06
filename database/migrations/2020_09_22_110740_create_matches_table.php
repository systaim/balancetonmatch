<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('home_team_id');
            $table->integer('home_score')->nullable();
            $table->unsignedBigInteger('away_team_id');
            $table->integer('away_score')->nullable();
            $table->date('date_match');
            $table->time('time');
            $table->string('location')->nullable();
            $table->enum('live',['attente','debut','mitemps','repriseMT','finDeMatch','reporte','annule','arrete'])->default('attente');
            $table->unsignedBigInteger('player_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('competition_id');
            $table->unsignedBigInteger('division_department_id');
            $table->unsignedBigInteger('region_region_id');
            $table->unsignedBigInteger('group_id');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('competition_id')->references('id')->on('competitions');
            $table->foreign('division_department_id')->references('id')->on('divisions_departments');
            $table->foreign('region_region_id')->references('id')->on('divisions_regions');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('home_team_id')->references('id')->on('clubs');
            $table->foreign('away_team_id')->references('id')->on('clubs');
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
        Schema::dropIfExists('matches');
    }
}
