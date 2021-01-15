<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
    		$table->id();
    		$table->integer('user_id');
    		$table->integer('product_id');
    		$table->integer('rate');
    		$table->text('review');
    		$table->integer('is_approved')->default('1');
        $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
