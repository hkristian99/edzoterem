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
            $table->foreignId("address_id")->constrained()->comment("address_billing_id");
            $table->foreignId("address_id")->constrained()->comment("address_shipping_id");;
            $table->foreignId("order_status_id")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->intiger("subtotal");
            $table->intiger("grandtotal");
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
