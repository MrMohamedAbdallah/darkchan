<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text("title");
            $table->string("name");
            $table->text("content");
            $table->string("file1");
            $table->string("file2");
            $table->string("password");
            $table->boolean("spoiler");
            $table->dateTime("last_action");
            $table->unsignedBigInteger("board_id");
            $table->foreign("board_id")->references("id")->on("boards")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('threads');
    }
}
