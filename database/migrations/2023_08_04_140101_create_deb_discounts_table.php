<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deb_discounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('claim_id');
            $table->foreign('claim_id')->references('id')->on('claims');
            $table->decimal('total_claim_amount', 20,2);
            $table->decimal('after_discount',20,2);

            $table->decimal('requested_percentage',20,2);
            $table->decimal('officer_percentage',20,2)->nullable();
            $table->boolean('status'); /// to check its approved or not [approved=true, rejected=false]
            $table->integer('requested_by');
            $table->integer('process_by')->nullable();
            $table->date('process_date')->nullable();

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
        Schema::dropIfExists('deb_discounts');
    }
}
