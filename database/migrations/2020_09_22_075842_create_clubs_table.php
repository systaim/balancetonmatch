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
            $table->string('name');
            $table->integer('numAffiliation');
            $table->string('logo_path')->nullable();
            $table->string('bg_path')->default('images/default-team.jpg');
            $table->string('primary_color')->default('#ffffff');
            $table->string('secondary_color')->default('#ffffff');
            $table->integer('number_teams')->nullable();
            $table->text('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('department_id')->references('id')->on('departments');

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
