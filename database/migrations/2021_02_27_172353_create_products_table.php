<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id', 50)->unique()->index();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 120);
            $table->text('description');
            $table->float('price');
            $table->float('cost');
            $table->integer('stock');
            $table->string('image');
            $table->enum('category',['drinks', 'food', 'dessert']);
            $table->string('slug')->unique();
            $table->softDeletes();
            $table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
