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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_name');
            $table->string('email' , 250)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('first_name' , 250)->nullable();
            $table->string('last_name' , 250)->nullable();
            $table->string('password' , 250);
            $table->string('phone' , 13)->nullable();
            $table->unsignedBigInteger('user_role_id');
            $table->unsignedBigInteger('user_status_id');
            $table->string('avatar' , 250);
            $table->integer('verification_code')->nullable();
            $table->string('company_name' , 250)->nullable();
            $table->string('company_phone' , 15)->nullable();
            $table->string('company_address' , 250)->nullable();
            $table->string('company_website' , 250)->nullable();
            $table->string('personal_website' , 250)->nullable();
            $table->unsignedBigInteger('user_company_role_id')->nullable();
            $table->string('date' , 250 );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
