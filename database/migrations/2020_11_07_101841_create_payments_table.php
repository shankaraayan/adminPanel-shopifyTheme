<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Payments;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
			$table->string('country');
			$table->string('state');
			$table->string('payment_mode');
			$table->integer('min_order_value');
			$table->integer('max_order_value');
            $table->timestamps();
        });
		
		Payments::firstOrCreate([
		    'country' => 'India',
		    'state' => 'All',
		    'payment_mode' => 'Online',
		    'min_order_value' => 0,
		    'max_order_value' => 0
		]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
