<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->string('id', 50)->unique()->index();
            $table->string('name',30);
            $table->string('last_name',30);
            $table->string('phone',30);
            $table->string('email')->unique();
            $table->unsignedBigInteger('address');
            $table->string('slug')->unique();
            $table->softDeletes();
            $table->timestamps();

			$table->foreign('address')->references('id')->on('addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
