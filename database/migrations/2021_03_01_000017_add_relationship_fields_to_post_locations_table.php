<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPostLocationsTable extends Migration
{
    public function up()
    {
        Schema::table('post_locations', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_3296666')->references('id')->on('teams');
            $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id', 'driver_fk_3296985')->references('id')->on('drivers');
        });
    }
}
