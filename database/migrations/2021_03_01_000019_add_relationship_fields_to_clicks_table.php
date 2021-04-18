<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClicksTable extends Migration
{
    public function up()
    {
        Schema::table('clicks', function (Blueprint $table) {
            $table->unsignedBigInteger('instance_id')->nullable();
            $table->foreign('instance_id', 'instance_fk_3296946')->references('id')->on('post_histories');
        });
    }
}
