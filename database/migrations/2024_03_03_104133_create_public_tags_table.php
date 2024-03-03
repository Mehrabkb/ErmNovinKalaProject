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
        Schema::create('public_tags', function (Blueprint $table) {
            $table->id('public_tag_id');
            $table->string('tags_title'  , 250);
            $table->text('tags_value');
            $table->string('date' , 250);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_tags');
    }
};
