<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('participant_poll_id')->index();
            $table->unsignedBigInteger('question_id')->index();
            $table->string('answer');
            $table->unique(['participant_poll_id', 'question_id'], 'uq_answer_per_poll');
            $table->timestamps();

            $table->foreign('participant_poll_id')->references('id')->on('participant_polls');
            $table->foreign('question_id')->references('id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
