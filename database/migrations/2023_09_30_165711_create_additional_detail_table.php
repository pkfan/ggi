<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('additional_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_id');
            $table->bigInteger('reference_no')->nullable(false);
            $table->string('date_time',255);
            $table->string('remarks')->nullable();
            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_detail');
    }
};
