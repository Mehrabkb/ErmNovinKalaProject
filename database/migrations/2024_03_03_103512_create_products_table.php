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
            $table->id('product_id');
            $table->string('title' , 250);
            $table->string('sku' , 250)->nullable();
            $table->string('main_image' , 250)->nullable();
            $table->text('description')->nullable();
            $table->integer('balance')->default(0);
            $table->bigInteger('price')->default(0);
            $table->unsignedBigInteger('product_category_id');
            $table->unsignedBigInteger('product_status_id');
            $table->unsignedBigInteger('user_publisher_id' );
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('product_brand_id');
            $table->string('custom_tags')->nullable();
            $table->date('date' , 250);
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
