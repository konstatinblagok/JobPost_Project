<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredentialDriverPivotTable extends Migration
{
    public function up()
    {
        Schema::create('credential_driver', function (Blueprint $table) {
            $table->unsignedBigInteger('credential_id');
            $table->foreign('credential_id', 'credential_id_fk_3296984')->references('id')->on('credentials')->onDelete('cascade');
            $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id', 'driver_id_fk_3296984')->references('id')->on('drivers')->onDelete('cascade');
        });
    }
}
