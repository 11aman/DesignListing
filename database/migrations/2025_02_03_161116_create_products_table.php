<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('product_category_id');  // Top-level category
            $table->unsignedBigInteger('sub_category_id')->nullable(); // Second level (subcategory)
            $table->unsignedBigInteger('finish_id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('structure_id');
            $table->unsignedBigInteger('design_category_id');
            $table->unsignedBigInteger('species_id');
            $table->unsignedBigInteger('color_id');
            $table->timestamps();
        
            // Foreign Key Constraints
            $table->foreign('product_category_id')->references('id')->on('product_categories');
            $table->foreign('sub_category_id')->references('id')->on('product_categories'); // Self-referencing
            $table->foreign('finish_id')->references('id')->on('finishes');
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->foreign('structure_id')->references('id')->on('structures');
            $table->foreign('design_category_id')->references('id')->on('design_categories');
            $table->foreign('species_id')->references('id')->on('species');
            $table->foreign('color_id')->references('id')->on('colors');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
