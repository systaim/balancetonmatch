<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentaireReactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaire_reaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commentaire_id');
            $table->unsignedBigInteger('reaction_id');
            $table->timestamps();

            $table->foreign('commentaire_id')->references('id')->on('commentaires');
            $table->foreign('reaction_id')->references('id')->on('reactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentaire_reaction');
    }
}
