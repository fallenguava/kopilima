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
            $table->string('email')->after('customer_name');
        });

        Schema::table('finished_orders', function (Blueprint $table) {
            $table->string('email')->after('customer_name');
        });

        Schema::table('canceled_orders', function (Blueprint $table) {
            $table->string('email')->after('customer_name');
        });
    }

    public function down()
    {
        Schema::table('ongoing_orders', function (Blueprint $table) {
            $table->dropColumn('email');
        });

        Schema::table('finished_orders', function (Blueprint $table) {
            $table->dropColumn('email');
        });

        Schema::table('canceled_orders', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }

};
