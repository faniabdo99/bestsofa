<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLocalsTable extends Migration
{
    public function up()
    {
        Schema::create('product__locals', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('lang_code');
            $table->string('title_value');
            $table->string('slug_value');
            $table->text('description_value');
            $table->text('body_value');
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
        Schema::dropIfExists('product__locals');
    }
}
