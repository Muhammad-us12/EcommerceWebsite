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
        Schema::create('product_assigned_attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('attribute_id');
            $table->string('value');
            $table->boolean('adjustable')->default(false);
            $table->float('min_value')->nullable();
            $table->float('max_value')->nullable();
            $table->string('product_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_assigned_attributes');
    }
};
