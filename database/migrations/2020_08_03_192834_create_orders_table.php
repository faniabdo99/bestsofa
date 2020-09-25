<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateOrdersTable extends Migration
{
    public function up(){
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //Order Main Data
            $table->string('serial_number');
            $table->string('lang')->default('en');
            $table->string('status')->default('Blueprint');
            $table->string('order_weight')->default('0');
            //Order Money Part
            $table->string('total_amount')->default('0');
            $table->string('is_paid')->default('no');
            $table->string('payment_id')->default('0');
            $table->string('payment_method')->default('0');
            $table->string('order_tax_rate')->default('0');
            $table->string('total_tax_amount')->default('0');
            $table->string('total_shipping_cost')->default('0');
            $table->string('total_shipping_tax')->default('0');
            $table->string('order_currency')->default('EUR');
            //Order User Data
            $table->string('user_id')->default('1');
            $table->string('first_name')->default('Default');
            $table->string('last_name')->default('Name');
            $table->string('company_name')->default('Company Default Name');
            $table->string('phone_number')->default('Company Phone Number');
            $table->string('email')->default('Default User Email');
            $table->string('address')->default('Default Address');
            $table->string('address_2')->nullable();
            $table->string('country')->default('Default Shipping Country');
            $table->string('city')->default('Default City');
            $table->string('zip_code')->default('Default Zip Code');
            $table->string('vat_number')->default('Default VAT Number');
            $table->string('is_vat_valid')->default('no');
            //Shipping Data
            $table->string('shipping_address')->nullable();
            $table->string('shipping_address_2')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_zip_code')->nullable();
            $table->string('pickup_at_store')->default('no');
            $table->text('tracking_link')->nullable();
            //Additional Data
            $table->integer('invoice_id')->nullable();
            $table->text('order_notes')->nullable();
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
