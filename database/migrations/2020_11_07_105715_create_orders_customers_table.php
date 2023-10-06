<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_customers', function (Blueprint $table) {
            $table->id();
			$table->foreignId('orders_id');
			$table->string('email');
			$table->string('subscribed_status');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('shipping_address');
			$table->string('shipping_city');
			$table->string('shipping_state');
			$table->string('shipping_country');
			$table->bigInteger('shipping_pincode');
			$table->bigInteger('phone');
			$table->string('billing_status');
			$table->string('billing_first_name');
			$table->string('billing_last_name');
			$table->string('billing_address');
			$table->string('billing_city');
			$table->string('billing_state');
			$table->string('billing_country');
			$table->bigInteger('billing_pincode');
			$table->bigInteger('billing_phone');
            $table->timestamps();
            $table->foreign('orders_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_customers');
    }
}
