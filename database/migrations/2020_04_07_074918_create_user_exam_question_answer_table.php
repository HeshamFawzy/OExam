<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserExamQuestionAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_exam_question_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('examiner_id')->unsigned();
            $table->Integer('exam_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->string('user_answer_option')->nullable();
            $table->string('marks');
            $table->timestamps();

            $table->foreign('examiner_id')->references('id')->on('examiners')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('online_exams')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_exam_question_answer');
    }
}
