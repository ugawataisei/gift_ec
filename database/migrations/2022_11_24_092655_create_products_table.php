<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('secondary_category_id');
            $table->unsignedBigInteger('image_first')->nullable();
            $table->unsignedBigInteger('image_second')->nullable();
            $table->unsignedBigInteger('image_third')->nullable();
            $table->unsignedBigInteger('image_fourth')->nullable();
            $table->string('name');
            $table->text('information')->nullable();
            $table->unsignedBigInteger('price');
            $table->boolean('is_selling');
            $table->unsignedBigInteger('sort_order')->nullable();

            $table->timestamps();

            //外部キー制約
            $table->foreign('shop_id')
                ->references('id')
                ->on('shops')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('secondary_category_id')
                ->references('id')
                ->on('secondary_categories');

            $table->foreign('image_first')
                ->references('id')
                ->on('images');

            $table->foreign('image_second')
                ->references('id')
                ->on('images');

            $table->foreign('image_third')
                ->references('id')
                ->on('images');

            $table->foreign('image_fourth')
                ->references('id')
                ->on('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
