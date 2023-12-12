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
        Schema::create('debtor_bank_transfers', function (Blueprint $table) {
            $table->id();
            // -- claim_id
            // -- updated_by (officer_id)
            // -- verified_by (admin, super-admin, director, manager, supervisor etc)
            // -- screenshot
            // -- amount
            // -- paid_date
            // -- status (1 = unverified, 2 = verified)
            $table->foreignId('claim_id')->constrained();
            $table->string('debtor_ip');
            $table->integer('verified_by')->nullable();
            $table->string('screenshot');
            $table->decimal('amount',20,2);
            $table->date('paid_at');
            $table->smallInteger('status');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debtor_bank_transfers');
    }
};
