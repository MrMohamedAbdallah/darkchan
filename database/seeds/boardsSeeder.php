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

        factory(App\Board::class, 20)->create()->each(function ($board){

            // Genereate random integer to decide how many threads will the boadr have
            $numberOfThreads = rand(3,15);

            // Generating treads
            $threads = factory(App\Thread::class, $numberOfThreads)->make();

            $board->threads()->saveMany($threads);



        });
    }
}
