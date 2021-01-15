<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    public function up()
    {
        Schema::create('order__products', function (Blueprint $table) {

		$table->id();
		$table->integer('order_id');
		$table->integer('user_id');
		$table->integer('product_id');
		$table->integer('is_free_shipping');
		$table->integer('qty');
    $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('order__products');
    }
}
