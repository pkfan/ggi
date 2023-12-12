<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebtorrefuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debtorrefuses', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('company_id');
            // $table->foreign('company_id')->references('id')->on('users');
            $table->unsignedBigInteger('debtorresponse_id');
            $table->foreign('debtorresponse_id')->references('id')->on('debtorresponses');
            $table->unsignedBigInteger('lawfirm_id');
            $table->foreign('lawfirm_id')->references('id')->on('users'); 
            $table->string('status')->nullable();
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
        Schema::dropIfExists('debtorrefuses');
    }
}
