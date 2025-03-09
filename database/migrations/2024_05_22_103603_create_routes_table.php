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
    Schema::create('routes', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name', 50);
        $table->text('description');
        $table->unsignedInteger('user_id')->nullable();

        $table->foreign('user_id')->references('id')->on('users');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
