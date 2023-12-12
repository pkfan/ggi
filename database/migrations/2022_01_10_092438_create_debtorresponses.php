<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebtorresponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debtorresponses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_id');
            $table->foreign('claim_id')->references('id')->on('claims');
            $table->string('response');
            $table->string('objection')->nullable();
            $table->string('obj_status')->nullable();
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
        Schema::dropIfExists('debtorresponses');
    }
}
