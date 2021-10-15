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
            $table->foreignId('club_id')->constrained()->nullable();
            $table->foreignId('region_id')->constrained()->nullable();
            $table->integer('total-merci')->default(0);
            $table->enum('role', ['super-admin', 'admin', 'manager', 'guest'])->default('guest');
            $table->unsignedBigInteger('is_player')->nullable();
            $table->boolean('first_com')->default(1);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            
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
