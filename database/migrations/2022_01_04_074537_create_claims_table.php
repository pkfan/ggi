<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cid');
            $table->foreign('cid')->references('id')->on('users');
            $table->string('rec_amt');
            $table->string('acc_date');
            $table->string('acc_location');
            $table->string('rec_reason');
            $table->string('deb_iqama');
            $table->string('deb_name')->nullable();
            $table->string('deb_age')->nullable();
            $table->string('deb_mob')->nullable();
            $table->string('deb_type')->nullable();
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
        Schema::dropIfExists('claims');
    }
}
