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
            $table->bigInteger('research_id');
            $table->bigInteger('screen_id');
            $table->mediumInteger('screen_order_number');
            $table->timestamps();
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
