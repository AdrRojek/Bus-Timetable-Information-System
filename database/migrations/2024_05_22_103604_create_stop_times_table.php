<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stop_times', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('route_id');
            $table->unsignedInteger('stop_id');
            $table->time('arrival_time');
            $table->time('departure_time');
            $table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('stop_id')->references('id')->on('stops');

        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stop_times');
    }
};
