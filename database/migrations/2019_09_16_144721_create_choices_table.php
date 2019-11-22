<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('question_id')->index();
            $table->string('title');
            $table->mediumInteger('choice_order_number');
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions');
        });
        
        DB::table('choices')->insert(
            [
                'question_id' => 1,
                'title' => 'I like him!',
                'choice_order_number' => 1
            ]
        );
        
        DB::table('choices')->insert(
            [
                'question_id' => 1,
                'title' => 'I wish I never had him',
                'choice_order_number' => 2
            ]
        );
        
        DB::table('choices')->insert(
            [
                'question_id' => 2,
                'title' => 'Your answer: ',
                'choice_order_number' => 1
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('choices');
    }
}
