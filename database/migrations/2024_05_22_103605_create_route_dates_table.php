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
        Schema::create('route_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('route_id');
            $table->date('date');
            $table->foreign('route_id')->references('id')->on('routes');

        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_dates');
    }
};
