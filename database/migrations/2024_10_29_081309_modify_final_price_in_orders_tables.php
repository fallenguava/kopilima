<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('ongoing_orders', function (Blueprint $table) {
            $table->decimal('final_price', 10, 2)->change();
        });

        Schema::table('finished_orders', function (Blueprint $table) {
            $table->decimal('final_price', 10, 2)->change();
        });

        Schema::table('canceled_orders', function (Blueprint $table) {
            $table->decimal('final_price', 10, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('ongoing_orders', function (Blueprint $table) {
            $table->decimal('final_price', 8, 2)->change();
        });

        Schema::table('finished_orders', function (Blueprint $table) {
            $table->decimal('final_price', 8, 2)->change();
        });

        Schema::table('canceled_orders', function (Blueprint $table) {
            $table->decimal('final_price', 8, 2)->change();
        });
    }

};
