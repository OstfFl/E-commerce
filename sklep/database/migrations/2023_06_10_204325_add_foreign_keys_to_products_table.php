<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
//            $table->unsignedBigInteger('product_images_id')->nullable();
//            $table->unsignedBigInteger('product_details_id')->nullable();
//
//            $table->foreign('product_images_id')->references('id')->on('product_images')->onDelete('cascade');
//            $table->foreign('product_details_id')->references('id')->on('product_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
