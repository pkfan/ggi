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
        Schema::create('request_change_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_id')->nullable(false);
            $table->string('current_status',255)->nullable(false);
            $table->string('new_status',255)->nullable(false);
            $table->string('reason',255)->nullable(false);
            $table->foreign('claim_id')->references('id')->on('claims');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_change_status');
    }
};
