<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('screen_id');
            $table->string('title');
            $table->text('description');
            $table->mediumInteger('question_order_number');
            $table->enum('question_type', ['option', 'text']);
            $table->timestamps();
        });
        
        DB::table('questions')->insert(
            [
                'screen_id' => 1,
                'title' => 'How do yo feel about your cat?',
                'description' => 'Choose one of the following',
                'question_order_number' => 1,
                'question_type' => 'option'
            ]
        );
        
        DB::table('questions')->insert(
            [
                'screen_id' => 1,
                'title' => 'What was your first teacher name',
                'description' => 'This is security question to qualify your ansver',
                'question_order_number' => 2,
                'question_type' => 'text'
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
        Schema::dropIfExists('questions');
    }
}
