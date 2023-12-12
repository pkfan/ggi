<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_id');
            $table
                ->foreign('claim_id')
                ->references('id')
                ->on('claims');
            $table->string('status');
            $table->Integer('update_by');
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
        Schema::dropIfExists('claim_status');
    }
}
