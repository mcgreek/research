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
            $table->bigInteger('poll_id');
            $table->bigInteger('participant_id');
            $table->boolean('completed');
            $table->unique(['poll_id', 'participant_id'], 'uq_participant_poll');
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
        Schema::dropIfExists('participant_polls');
    }
}
