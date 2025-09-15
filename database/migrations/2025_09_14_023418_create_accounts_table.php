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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email', 191)->unique();
            //encrypted
            $table->binary('account_number');
            $table->binary('balance');
            $table->binary('ssn');
            // blind indexes for querying
            $table->string('account_number_index', 64)->unique();
            $table->string('ssn_index', 64)->index();
            $table->string('balance_index')->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
