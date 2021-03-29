<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('sale_id',50)->unique();
            $table->date('estimated_date')->nullable()->change();
            $table->date('delivered_date')->nullable()->change();
            $table->text('place');
            $table->enum('status',['Delivered', 'Pending', 'Canceled', 'On the way']);
            $table->softDeletes();
            $table->timestamps();

			$table->foreign('sale_id')->references('id')->on('sales');
        });
    }

    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
