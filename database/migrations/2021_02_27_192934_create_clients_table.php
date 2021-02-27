<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->string('name', 30);
            $table->string('last_name', 30);
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('payment_method', ['cash', 'card']);
            $table->string('phone', 30);
            $table->enum('client_type', ['whatsApp', 'facebook', 'instagram']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
