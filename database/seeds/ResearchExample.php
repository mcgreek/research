<?php

use Illuminate\Database\Seeder;

class ResearchExample extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// First create research
        $researchId = DB::table('researches')->insertGetId(
        	[
        		'title' => 'Cats vs Dogs'
        	]
        );

        // then create screen
        $screenId = DB::table('screens')->insertGetId(
            [
                'title' => 'Answer the following questions'
            ]
        );

        //Add screen to research and make it first
        DB::table('research_screens')->insert(
            [
                'research_id' => $researchId,
                'screen_id' => $screenId,
                'screen_order_number' => 1
            ]
        );

        /**
         * QUESTION & OPTIONS
         *
         * add questions to the screen and specify an order
         * question_type => 'option' means you have to select one option
         */
        $question1Id = DB::table('questions')->insertGetId(
            [
                'screen_id' => $screenId,
                'title' => 'Are you more cat or a dog person?',
                'description' => 'Choose one of the following',
                'question_order_number' => 1,
                'question_type' => 'option'
            ]
        );

        // option 1
        DB::table('choices')->insert(
            [
                'question_id' => $question1Id,
                'title' => 'I\'m a cat person',
                'choice_order_number' => 1
            ]
        );
        
        // option 2
        DB::table('choices')->insert(
            [
                'question_id' => $question1Id,
                'title' => 'Dogs rule :)',
                'choice_order_number' => 2
            ]
        );
        /**
         * 
         */

        /**
         * QUESTION & OPTIONS
         *
         * question_type => 'text' means you have to insert some text
         */
        $question2Id = DB::table('questions')->insertGetId(
            [
                'screen_id' => $screenId,
                'title' => 'Name your pet',
                'description' => 'What\'s your pet name or how would you call it?',
                'question_order_number' => 2,
                'question_type' => 'text'
            ]
        );

        DB::table('choices')->insert(
            [
                'question_id' => $question2Id,
                'title' => 'Type name: ',
                'choice_order_number' => 1
            ]
        );

        /**
         * 
         */
    }
}
