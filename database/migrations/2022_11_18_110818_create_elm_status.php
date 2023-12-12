<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElmStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elm_status', function (Blueprint $table) {
            $table->id();
            $table->Integer('claim_id');
            $table->text('batch_no')->nullable();
            $table->string('status')->nullable();
            $table->string('batch_ident')->nullable();
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
        Schema::dropIfExists('elm_status');
    }
}
