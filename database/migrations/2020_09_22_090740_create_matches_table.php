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
            $table->string('slug');
            $table->enum('live',['attente','debut','mitemps','repriseMT','finDeMatch','reporte','annule','arrete','prolongations1','MTProlongations','prolongations2','finProlongations','tab'])->default('attente');
            $table->unsignedBigInteger('home_team_id');
            $table->integer('home_score')->nullable();
            $table->unsignedBigInteger('away_team_id');
            $table->integer('away_score')->nullable();
            $table->datetime('date_match');
            $table->datetime('debut_match_reel')->nullable();
            $table->datetime('fin_match_reel')->nullable();
            $table->datetime('debut_prolongations')->nullable();
            $table->datetime('fin_prolongations')->nullable();
            $table->string('location')->nullable();
            $table->unsignedBigInteger('competition_id');
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('division_region_id')->nullable();
            $table->unsignedBigInteger('division_department_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('competition_id')->references('id')->on('competitions');
            $table->foreign('division_department_id')->references('id')->on('divisions_departments');
            $table->foreign('division_region_id')->references('id')->on('divisions_regions');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('user_id')->references('id')->on('users');
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
