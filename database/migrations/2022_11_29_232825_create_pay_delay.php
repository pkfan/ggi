<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayDelay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_delay', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_id');
            $table
                ->foreign('claim_id')
                ->references('id')
                ->on('claims');
            $table->string('date_time');
            $table->Integer('status')->default('1');
            $table->Integer('update_by');
            $table->text('link')->nullable();
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
        Schema::dropIfExists('pay_delay');
    }
}
