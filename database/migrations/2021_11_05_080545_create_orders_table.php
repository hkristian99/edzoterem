<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('address_billing_id');
            $table->foreign('address_billing_id')->references('id')->on('addresses');
            $table->unsignedBigInteger('address_shipping_id');
            $table->foreign('address_shipping_id')->references('id')->on('addresses');
            $table->foreignId("order_status_id")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->integer("subtotal");
            $table->integer("grandtotal");
            $table->string("notes");
            $table->foreignId("paymode_id")->constrained();
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
        Schema::dropIfExists('orders');
    }
}
