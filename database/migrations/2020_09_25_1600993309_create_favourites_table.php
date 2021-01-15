<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavouritesTable extends Migration
{
    public function up()
    {
        Schema::create('favourites', function (Blueprint $table) {

		$table->id();
		$table->integer('product_id');
		$table->integer('user_id');
    $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('favourites');
    }
}
