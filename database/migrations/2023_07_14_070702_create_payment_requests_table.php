<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_payment_requests', function (Blueprint $table) {
            $table->id();
            $table->string('payment_amount');
            $table->string('transaction_id');
            $table->string('payment_method');
            $table->string('invoice_no');
            $table->string('payment_date');
            $table->string('status');
            $table->text('message')->nullable();
            $table->string('customer_id');
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
        Schema::dropIfExists('payment_requests');
    }
};
