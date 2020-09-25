<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {

		$table->id();
		$table->string('user_id');
		$table->integer('product_id');
		$table->string('status')->default('active');
		$table->integer('qty');
		$table->string('applied_coupon')->nullable();
		$table->string('coupon_amount')->nullable();
    $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
