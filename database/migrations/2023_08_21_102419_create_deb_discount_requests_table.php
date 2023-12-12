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
        Schema::create('deb_discount_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deb_discount_id');
            $table->foreign('deb_discount_id')->references('id')->on('deb_discounts');
            $table->decimal('officer_percentage',20,2);
            $table->decimal('requested_percentage',20,2);
            $table->boolean('status'); /// to check its approved or not [approved=true, rejected=false]
            $table->integer('requested_by');
            $table->integer('process_by')->nullable();
            $table->date('process_date')->nullable();

            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deb_discount_requests');
    }
};
