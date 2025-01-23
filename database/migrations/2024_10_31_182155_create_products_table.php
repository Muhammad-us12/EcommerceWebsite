<?php

use App\Enums\ProductSize;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('size', array_column(ProductSize::cases(), 'value'));
            $table->string('slug');
            $table->text('description')->nullable();
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('brand_id');
            $table->float('price');
            $table->integer('rent_for_days');
            $table->float('cost_price');
            $table->float('quantity')->default(1);
            $table->float('security_deposit');
            $table->string('status')->default('active');
            $table->boolean('display_on_website')->default('true');
            $table->text('review_remarks')->nullable();
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
