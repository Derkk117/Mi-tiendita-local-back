<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeColumnsToDeliveries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->date('estimated_date')->nullable()->change();
            $table->date('delivered_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->string('estimated_date')->nullable()->change();
            $table->string('delivered_date')->nullable()->change();
        });
    }
}
