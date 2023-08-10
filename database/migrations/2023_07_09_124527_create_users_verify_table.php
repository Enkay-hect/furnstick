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
        Schema::create('users_verify', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('token');
            $table->integer('verified')->default(0);
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */


    public function down()
    {
        Schema::dropIfExists('users_verify');
    }
};
