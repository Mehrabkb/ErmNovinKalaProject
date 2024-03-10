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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id('product_category_id');
            $table->string('english_category' , 250)->nullable();
            $table->string('persian_category' , 250)->nullable();
            $table->unsignedBigInteger('parent_category_id')->default(0);
            $table->string('image' , 250)->nullable();
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->string('date' , 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
