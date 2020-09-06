<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreatePaymentMethodsTable extends Migration{
    public function up(){
        Schema::create('payment__methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code_name');
            $table->string('percentage_fee');
            $table->string('fixed_fee');
            $table->string('refund_fee');
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
        Schema::dropIfExists('payment__methods');
    }
}
