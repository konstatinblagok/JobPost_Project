<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('post_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->string('title');
            $table->string('url');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
