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
        Schema::create('baskets', function (Blueprint $table) {
            $table->id('basket_id');
            $table->unsignedBigInteger('user_id');
            $table->double('total_price')->default(0);
            $table->string('date' , 250);
            $table->string('status')->default('first-step')->nullable();
            $table->boolean('official_bill')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baskets');
    }
};
