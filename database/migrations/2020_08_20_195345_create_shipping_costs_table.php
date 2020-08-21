<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateShippingCostsTable extends Migration{
    public function up(){
        Schema::create('shipping_costs', function (Blueprint $table) {
            $table->id();
            $table->string('shipping_method');
            $table->string('country_name');
            $table->integer('weight_from');
            $table->integer('weight_to');
            $table->string('cost');
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('shipping_costs');
    }
}
