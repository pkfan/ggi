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
        Schema::create('legal_department_model', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_id');
            $table->integer('status')->nullable(false)->default(0);
            $table->integer('court')->nullable(false)->default(4);
            $table->string('remarks',255)->nullable();
            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_department_model');
    }
};
