<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('images');
            $table->unsignedBigInteger('match_id');
            $table->unsignedBigInteger('commentator_id');
            $table->timestamps();

            $table->foreign('match_id')->references('id')->on('matches');
            $table->foreign('commentator_id')->references('id')->on('commentators');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galleries');
    }
}
