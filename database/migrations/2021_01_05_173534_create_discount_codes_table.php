<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->id();
            $table->string('discountCode');
            $table->string('discountType')->default('percentage');
            $table->integer('discountValue');
			$table->integer('discountMinPurchaseAmt')->nullable()->default('0');
            $table->date('discountStartDate');
            $table->date('discountEndDate')->nullable();
            $table->string('discountStatus');
            $table->string('discountOncePerUser');
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
        Schema::dropIfExists('discount_codes');
    }
}
