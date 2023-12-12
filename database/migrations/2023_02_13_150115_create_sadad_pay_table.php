<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSadadPayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sadad_pay', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_id');
            $table->foreign('claim_id')->references('id')->on('claims');
            $table->string('tranid');
            $table->string('trackid');
            $table->string('amount');
            $table->string('sadadNumber');
            $table->string('billNumber');
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
        Schema::dropIfExists('sadad_pay');
    }
}
