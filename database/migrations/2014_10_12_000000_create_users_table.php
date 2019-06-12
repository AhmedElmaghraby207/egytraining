<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('user_name')->unique();
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('verifyToken')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->boolean('active')->default(0);
            $table->boolean('gender')->default(1);
            $table->boolean('trainer')->default(0);
            $table->boolean('coach')->default(0);
            $table->text('about')->nullable();
            $table->string('qualification')->nullable();
            $table->string('career')->nullable();
            $table->string('specialize')->nullable();
            $table->text('cv')->nullable();
            $table->text('cv_url')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
