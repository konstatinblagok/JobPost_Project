<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostingPostLocationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('job_posting_post_location', function (Blueprint $table) {
            $table->unsignedBigInteger('job_posting_id');
            $table->foreign('job_posting_id', 'job_posting_id_fk_3296745')->references('id')->on('job_postings')->onDelete('cascade');
            $table->unsignedBigInteger('post_location_id');
            $table->foreign('post_location_id', 'post_location_id_fk_3296745')->references('id')->on('post_locations')->onDelete('cascade');
        });
    }
}
