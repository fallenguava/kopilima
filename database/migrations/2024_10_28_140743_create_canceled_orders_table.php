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
        Schema::create('canceled_orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->text('all_items');
            $table->decimal('final_price', 8, 2);
            $table->string('customer_name');
            $table->integer('table_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canceled_orders');
    }
};
