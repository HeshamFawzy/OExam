<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examiners', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_id')->unsigned();
            $table->string('gender');
            $table->longText('address');
            $table->string('mobile_no');
            $table->string('filename')->nullable();
            $table->string('mime')->nullable();
            $table->string('original_filename')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examiners');
    }
}
