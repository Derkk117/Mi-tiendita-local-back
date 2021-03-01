<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('address_id');
            $table->string('street');
            $table->string('external_street', 30);
            $table->string('internal_street', 30);
            $table->string('suburb');
            $table->enum('state', ['Local', 'Extranjero']);
            $table->string('postal_code', 8);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
