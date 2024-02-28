<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('furniture_image', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('furniture_id');
            $table->string('name');
            $table->string('url');

            $table->foreign('furniture_id')->references('id')->on('furniture')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furniture_image');
    }
};
