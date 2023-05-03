<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attachments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('listing_id')->nullable();
            $table->bigInteger('color_id')->nullable();
            $table->bigInteger('material_id')->nullable();
            $table->string('image')->nullable();
            $table->string('image_original_name')->nullable();
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
        Schema::dropIfExists('product_attachments');
    }
}
