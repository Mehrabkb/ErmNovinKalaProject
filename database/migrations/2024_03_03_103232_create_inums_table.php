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
        Schema::create('inums', function (Blueprint $table) {
            $table->id('inum_id');
            $table->string('inum_key' , 250);
            $table->string('inum_value' , 250);
            $table->string('date' , 250);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inums');
    }
};
