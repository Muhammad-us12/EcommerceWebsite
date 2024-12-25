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
        Schema::create('make_payments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->float('prev_balance');
            $table->float('updated_balance');
            $table->float('total_payments');
            $table->integer('account_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('make_payments');
    }
};
