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
			$table->bigInteger('custom_order_id');
			$table->string('cust_email');
			$table->decimal('subtotal', 8, 2);
			$table->string('discount_category');
			$table->string('discount_name');
			$table->string('discount_type');
			$table->integer('discount_value');
			$table->decimal('discount', 8, 2);
			$table->string('shipping_name');
			$table->integer('shipping_cost');
			$table->integer('cod_charges');
			$table->decimal('tax', 8, 2);
			$table->decimal('total_amount', 8, 2);
			$table->string('payment_mode');
			$table->string('payment_status');
			$table->string('razorpay_orderID');
			$table->string('razorpay_paymentID');
			$table->string('razorpay_signature');
			$table->string('order_status');
			$table->string('shipping_carrier')->nullable();
			$table->string('shipping_tracking_number')->nullable();
			$table->string('shipping_tracking_link')->nullable();
			$table->string('return_carrier')->nullable();
			$table->string('return_tracking_number')->nullable();
			$table->string('return_tracking_link')->nullable();
			$table->string('event_trigger');
            $table->timestamps();
        });
		
		DB::update('ALTER TABLE orders AUTO_INCREMENT = 1001');
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
