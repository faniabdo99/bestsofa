<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(){
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->text('body');
            $table->string('image');
            $table->integer('category_id');
            $table->integer('price');
            $table->integer('show_inventory')->default(0);
            $table->integer('inventory')->default(0);
            $table->string('statues');
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->integer('width')->nullable();
            $table->integer('tax_rate');
            $table->integer('is_promoted')->default(0);
            $table->integer('allow_reviews')->default(1);
            $table->integer('allow_reservations')->default(1);
            $table->integer('user_id');
            $table->string('tags');
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
        Schema::dropIfExists('products');
    }
}
