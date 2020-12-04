<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('abbreviation')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->string('name');
            $table->integer('numAffiliation');
            $table->string('logo_path')->nullable();
            $table->integer('number_teams')->nullable();
            $table->text('address')->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('primary_color')->default('#fff');
            $table->string('secondary_color')->default('#fff');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('region_id')->references('id')->on('regions');

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
        Schema::dropIfExists('clubs');
    }
}
