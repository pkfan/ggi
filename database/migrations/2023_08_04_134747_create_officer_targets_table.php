<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficerTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officer_targets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('officer_id');
            $table->foreign('officer_id')->references('id')->on('users');
            $table->string('total');
            $table->string('achieved')->nullable();
            $table->string('pending')->nullable();
            $table->integer('acheived_percentage')->nullable();
            $table->integer('status')->nullable();
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('officer_targets');
    }
}
