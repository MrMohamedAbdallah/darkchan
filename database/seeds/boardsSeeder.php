<?php

use Illuminate\Database\Seeder;

use App\Board;
use Faker\Factory;

use Illuminate\Support\Facades\DB;

class boardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Drop all rows
        DB::table("boards")->delete();
        DB::table("threads")->delete();
        DB::table("comments")->delete();

        factory(App\Board::class, 20)->create()->each(function ($board){

            // Genereate random integer to decide how many threads will the boadr have
            $numberOfThreads = rand(3,15);

            // Generating treads
            $threads = factory(App\Thread::class, $numberOfThreads)->make()->each(function($thread) use($board){


                $thread->board_id = $board->id;

                // Generating random commetns number
                $numberOfComments = rand(3,15);

                // Generatiog comments
                $comments = factory(App\Comment::class, $numberOfComments)->make();

               
                $thread->save();

                // Save the threads with thier comments
                $thread->comments()->saveMany($comments);

            });
            // $board->threads()->saveMany($threads);
        });
    }
}
