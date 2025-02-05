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
        Schema::create('design_finish_size', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('design_id');
            $table->unsignedBigInteger('finish_id');
            $table->unsignedBigInteger('size_id');
            $table->foreign('design_id')->references('id')->on('designs');
            $table->foreign('finish_id')->references('id')->on('finishes');
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_finish_size');
    }
};
