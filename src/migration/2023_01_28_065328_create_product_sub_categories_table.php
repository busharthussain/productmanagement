<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('product_type_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('hash_name')->nullable();
            $table->string('image')->nullable();
            $table->mediumText('artical')->nullable();
            $table->string('unique_id')->nullable();
            $table->string('meta_data')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sub_categories');
    }
}
