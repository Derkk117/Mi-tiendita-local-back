<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->string('id', 50)->unique()->index();
            $table->string('client_id', 50);
            $table->unsignedBigInteger('user_id');
            $table->text('products');
            $table->enum('payment_method', ["cash","card"]);
            $table->string('card_number')->nullable();
            $table->string('card_cvc')->nullable();
            $table->date('expiration_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('client_id')->references('id')->on('clients');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
