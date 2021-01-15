<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {

		$table->id();
		$table->integer('order_id');
		$table->string('user_id',11255);
		$table->text('customer_name')->nullable();
		$table->string('address')->nullable();
		$table->string('city')->nullable();
		$table->string('country')->nullable();
		$table->string('phone_number')->nullable();
		$table->string('email')->nullable();
		$table->text('customer_desc')->nullable();
		$table->string('vat_number')->nullable();
		$table->string('payment_method');
		$table->string('order_serial_number');
		$table->datetime('due_date')->nullable();
		$table->string('invoice_prefix')->default('2020-0100');
		$table->integer('is_paid');
    $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
