<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_listings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('product_type_id')->nullable();
            $table->bigInteger('sub_category_id')->nullable();
            $table->bigInteger('brand_id')->nullable();
            $table->bigInteger('style_id')->nullable();
            $table->string('color_id')->nullable();
            $table->string('material_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('depth')->nullable();
            $table->double('price', 15, 2)->default(0);
            $table->double('discount')->default(0);
            $table->mediumText('description')->nullable();
            $table->integer('guarantee')->nullable();
            $table->string('guarantee_type')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('is_on_sale')->default(0)->comment('0=no,1=yes');
            $table->string('meta_data')->nullable();
            $table->string('meta_description')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('hash_name')->nullable();
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
        Schema::dropIfExists('product_listings');
    }
}
