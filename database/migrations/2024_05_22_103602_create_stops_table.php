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
    Schema::create('stops', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name', 100);
        $table->string('address', 255);
        $table->string('stoppic',255);

    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stops');
    }
};
