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
        Schema::create('collection_office', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_id')->nullable(false);
            $table->unsignedBigInteger('collector_id')->nullable(false);
            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');
            $table->foreign('collector_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('remarks',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_office');
    }
};
