<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderlogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references('id')->on('users');
            $table->foreignId("order_user_id")->references('id')->on('users');
            $table->foreignId("order_id")->references('id')->on('orders');
            $table->boolean('status')->default(false);

            $table->unique(['user_id', 'order_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderlogs');
    }
};
