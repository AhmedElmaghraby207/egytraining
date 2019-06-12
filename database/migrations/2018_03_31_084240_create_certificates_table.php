<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('cer_name')->unique();
            $table->string('slug')->unique();
            $table->string('cer_owner');
            $table->integer('course_id')->unsigned();
            $table->integer('coach_id')->unsigned();
            $table->boolean('active')->default(0);
            $table->boolean('cer_status')->default(0); //free0 or not1
            $table->integer('cer_price')->nullable();
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
        Schema::dropIfExists('certificates');
    }
}
