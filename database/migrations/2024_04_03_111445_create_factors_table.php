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
        Schema::create('factors', function (Blueprint $table) {
            $table->id('factor_id');
            $table->unsignedBigInteger('user_id');
            $table->double('total_price')->default(0);
            $table->string('date' , 250)->default(\Carbon\Carbon::now()->timestamp);
            $table->string('status', 250)->default('pre-factor');
            $table->boolean('official_bill')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factors');
    }
};
