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
        Schema::create('furniture', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('material1_id');
            $table->unsignedBigInteger('material2_id');
            $table->unsignedBigInteger('material3_id');
            $table->unsignedBigInteger('material4_id');
            $table->string('sku')->unique();
            $table->string('name')->unique();
            $table->unsignedInteger('length');
            $table->unsignedInteger('width');
            $table->unsignedInteger('height');
            $table->string('size');
            $table->float('price');
            $table->unsignedBigInteger('stock')->default(0);

            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('material1_id')->references('id')->on('material1')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('material2_id')->references('id')->on('material2')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('material3_id')->references('id')->on('material3')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('material4_id')->references('id')->on('material4')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furniture');
    }
};
