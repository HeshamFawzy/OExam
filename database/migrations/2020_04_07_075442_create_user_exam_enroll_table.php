<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserExamEnrollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_exam_enrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('examiner_id')->unsigned();
            $table->integer('exam_id')->unsigned();
            $table->string('attendance_status');
            $table->timestamps();

            $table->foreign('examiner_id')->references('id')->on('examiners')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('online_exams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_exam_enroll');
    }
}
