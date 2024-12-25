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
        Schema::create('party_ledgers', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('party_id');
            $table->float('payment')->nullable();
            $table->float('received')->nullable();
            $table->float('price')->nullable();
            $table->float('balance');
            $table->integer('ingredient_purchase_id')->nullable();
            $table->integer('sale_id')->nullable();
            $table->integer('payment_id')->nullable();
            $table->integer('recevied_id')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('party_ledgers');
    }
};
