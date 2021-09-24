<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('pseudo')->unique();
            $table->string('email')->unique();
            $table->text('profile_photo_path')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->date('date_of_birth')->nullable();
            $table->integer('tel')->nullable();
            $table->float('note_commentaires')->nullable();
            $table->integer('club_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->integer('total-merci')->default(0);
            $table->enum('role', ['super-admin', 'admin', 'manager', 'guest'])->default('guest');
            $table->unsignedBigInteger('is_player')->nullable();
            $table->boolean('first_com')->default(1);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('club_id')->references('id')->on('clubs');
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
        Schema::dropIfExists('users');
    }
}
