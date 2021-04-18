<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPostHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('post_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('job_post_id');
            $table->foreign('job_post_id', 'job_post_fk_3296739')->references('id')->on('job_postings');
            $table->unsignedBigInteger('post_location_id');
            $table->foreign('post_location_id', 'post_location_fk_3296740')->references('id')->on('post_locations');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_3296744')->references('id')->on('teams');
        });
    }
}
