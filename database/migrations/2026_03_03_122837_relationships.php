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
        Schema::table('users' , function(Blueprint $table){
            $table->foreign('user_role_id')->references('user_role_id')->on('user_roles');
            $table->foreign('user_status_id')->references('user_status_id')->on('user_statuses');
            $table->foreign('user_company_role_id')->references('user_company_role_id')->on('user_company_roles');
        });
        Schema::table('products' , function(Blueprint $table){
            $table->foreign('product_category_id')->references('product_category_id')->on('product_categories');
            $table->foreign('product_status_id')->references('product_status_id')->on('product_statuses');
            $table->foreign('user_publisher_id')->references('user_id')->on('users');
            $table->foreign('product_brand_id')->references('product_brand_id')->on('product_brands');
        });
        Schema::table('product_images' , function(Blueprint $table){
            $table->foreign('product_id')->references('product_id')->on('products');
        });
        Schema::table('product_feature_connections' , function(Blueprint $table){
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('product_feature_id')->references('product_feature_id')->on('product_features');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
