<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantPollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_polls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('poll_id')->index();
            $table->unsignedBigInteger('participant_id')->index();
            $table->boolean('completed');
            $table->unique(['poll_id', 'participant_id'], 'uq_participant_poll');
            $table->timestamps();

            $table->foreign('poll_id')->references('id')->on('polls');
            $table->foreign('participant_id')->references('id')->on('participants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participant_polls');
    }
}
