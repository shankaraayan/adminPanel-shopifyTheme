<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('users_id');
			$table->string('email')->unique();
			$table->string('subscribed_status')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('shipping_address')->nullable();
			$table->string('shipping_city')->nullable();
			$table->string('shipping_state')->nullable();
			$table->string('shipping_country')->nullable();
			$table->bigInteger('shipping_pincode')->nullable();
			$table->bigInteger('phone')->nullable();
			$table->string('billing_status')->nullable();
			$table->string('billing_first_name')->nullable();
			$table->string('billing_last_name')->nullable();
			$table->string('billing_address')->nullable();
			$table->string('billing_city')->nullable();
			$table->string('billing_state')->nullable();
			$table->string('billing_country')->nullable();
			$table->bigInteger('billing_pincode')->nullable();
			$table->bigInteger('billing_phone')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
