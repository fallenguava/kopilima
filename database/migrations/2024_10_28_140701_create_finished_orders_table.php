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
        Schema::create('finished_orders', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedBigInteger('order_id'); // Keep order_id as a regular column
            $table->text('all_items');
            $table->decimal('final_price', 8, 2);
            $table->string('customer_name');
            $table->integer('table_number');
            $table->timestamps();

            // Optionally add a foreign key if necessary
            // $table->foreign('order_id')->references('order_id')->on('ongoing_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finished_orders');
    }
};
