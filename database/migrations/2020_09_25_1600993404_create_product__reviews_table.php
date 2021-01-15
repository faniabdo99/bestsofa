<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('product__reviews', function (Blueprint $table) {

		$table->id();
    $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('product__reviews');
    }
}
