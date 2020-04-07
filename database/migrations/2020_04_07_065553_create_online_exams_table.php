<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_exams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('online_exam_title');
            $table->dateTime('online_exam_datetime');
            $table->string('online_exam_duration');
            $table->Integer('total_question');
            $table->string('marks_per_right_answer');
            $table->string('marks_per_wrong_answer');
            $table->enum('online_exam_status', ['pending', 'started' , 'completed']);
            $table->string('online_exam_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('online_exams');
    }
}
