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
       
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('product_description');
            $table->decimal('mrp', 10, 2); // Example decimal with precision 10 and scale 2
            $table->decimal('selling_price', 10, 2); // Example decimal with precision 10 and scale 2
            $table->string('product_image');
            $table->string('multiple_image'); // Store image path instead of the image itself
            $table->boolean('is_stock');
            $table->integer('available_quantity')->unsigned();
            $table->string('status');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
