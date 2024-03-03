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
        Schema::create('product_feature_connections', function (Blueprint $table) {
            $table->id('product_feature_connection_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_feature_id');
            $table->date('date' , 250);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_feature_connections');
    }
};
