<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsDebtorrefuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('debtorrefuses', function (Blueprint $table) {
            $table->string('caseprogress')->nullable();
            $table->string('add_doc')->nullable();
            $table->string('verdict')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('debtorrefuses', function (Blueprint $table) {
            //
        });
    }
}
