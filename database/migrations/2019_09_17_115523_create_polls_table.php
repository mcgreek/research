<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('research_id')->index();
            $table->string('token', 255)->unique();
            $table->unsignedBigInteger('parent_poll_id')->index()->nullable();
            $table->boolean('is_anonymus')->default(0);
            $table->boolean('allow_sharing')->default(0);
            $table->timestamps();

            $table->foreign('research_id')->references('id')->on('researches');
            $table->foreign('parent_poll_id')->references('id')->on('polls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polls');
    }
}
