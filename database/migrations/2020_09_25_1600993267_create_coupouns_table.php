<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoupounsTable extends Migration
{
    public function up()
    {
        Schema::create('coupouns', function (Blueprint $table) {

		$table->id();
		$table->string('coupoun_code');
		$table->string('discount_type');
		$table->string('discount_amount');
		$table->string('amount');
    $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('coupouns');
    }
}
