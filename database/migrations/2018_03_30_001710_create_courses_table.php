<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('cover')->nullable();
            $table->integer('coach_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned();
            $table->boolean('status')->default(0); //free or not
            $table->integer('price')->nullable();
            $table->text('start_at')->nullable();
            $table->text('finish_at')->nullable();
            $table->text('needs')->nullable();
            $table->string('video_link')->nullable();
            $table->string('video')->nullable();
            $table->boolean('male')->default(0)->nullable();
            $table->boolean('female')->default(0)->nullable();
            $table->boolean('active')->default(0); //control by admin
            $table->boolean('published')->default(0); //control by coach
            $table->boolean('completed')->default(0);
            $table->timestamps();

            $table->foreign('coach_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
