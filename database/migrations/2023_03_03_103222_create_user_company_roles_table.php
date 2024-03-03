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
        Schema::create('user_company_roles', function (Blueprint $table) {
            $table->id('user_company_role_id');
            $table->string('english_name' , 250);
            $table->string('persian_name' , 250);
            $table->string('date' , 250);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_company_roles');
    }
};
