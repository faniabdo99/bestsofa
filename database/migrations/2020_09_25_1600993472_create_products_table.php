<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

		$table->id();
		$table->string('title');
		$table->string('slug');
		$table->text('description');
		$table->text('body');
		$table->string('image');
		$table->integer('category_id');
		$table->string('price');
		$table->integer('show_inventory')->default('0');
		$table->integer('inventory')->default('0');
		$table->integer('fake_inventory')->default('0');
		$table->integer('min_order')->default('0');
		$table->string('status');
		$table->float('weight')->nullable();
		$table->integer('height')->nullable();
		$table->integer('width')->nullable();
		$table->decimal('tax_rate',11,2);
		$table->integer('discount_id')->nullable();
		$table->integer('is_promoted')->default('0');
		$table->integer('allow_reviews')->default('1');
		$table->integer('allow_reservations')->default('1');
		$table->integer('user_id');
		$table->string('fabrics')->nullable();
    $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
