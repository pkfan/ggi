<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Payment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_id');
            $table->foreign('claim_id')->references('id')->on('claims')->cascadeOnDelete();
            $table->string('payment_id')->nullable();
            $table->string('result')->nullable();
            $table->string('track_id')->nullable();
            $table->string('auth_code')->nullable();
            $table->string('response_code')->nullable();
            $table->string('rrn')->nullable();
            $table->string('amount')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('masked_pan')->nullable();
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
        Schema::dropIfExists('payment');
    }
}
