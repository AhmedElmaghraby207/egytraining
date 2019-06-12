<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->string('question')->unique();
            $table->string('slug')->unique();
            $table->string('first_ans');
            $table->string('second_ans');
            $table->string('third_ans');
            $table->string('correct_ans'); //forth_ans

            $table->integer('course_id')->unsigned();
            $table->integer('coach_id')->unsigned()->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('completed')->default(0);
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('coach_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
