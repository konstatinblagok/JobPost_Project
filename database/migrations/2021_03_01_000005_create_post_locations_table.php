<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('post_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
