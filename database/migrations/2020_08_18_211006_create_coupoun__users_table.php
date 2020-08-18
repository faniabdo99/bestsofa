<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoupounUsersTable extends Migration
{
    public function up(){
        Schema::create('coupoun__users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('coupoun_id');
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
        Schema::dropIfExists('coupoun__users');
    }
}
