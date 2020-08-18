<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(){
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('serial-number');
            $table->string('user_id');
            $table->string('lang');
            $table->string('total_amount');
            $table->string('status');
            $table->string('is_paid');
            $table->string('payment_method');
            $table->string('tax_rate');
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
        Schema::dropIfExists('orders');
    }
}
