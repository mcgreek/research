<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchScreensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_screens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('research_id')->index();
            $table->unsignedBigInteger('screen_id')->index();
            $table->mediumInteger('screen_order_number');
            $table->timestamps();

            $table->foreign('research_id')->references('id')->on('researches');
            $table->foreign('screen_id')->references('id')->on('screens');
        });
        
        DB::table('research_screens')->insert(
            [
                'research_id' => 1,
                'screen_id' => 1,
                'screen_order_number' => 1
            ]
        );
        
        DB::table('research_screens')->insert(
            [
                'research_id' => 2,
                'screen_id' => 1,
                'screen_order_number' => 1
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
        Schema::dropIfExists('research_screens');
    }
}
