<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomaticDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automatic_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('discountTitle');
            $table->string('discountType')->default('percentage');
            $table->integer('discountValue');
            $table->integer('discountMinPurchaseAmt')->nullable()->default('0');
            $table->date('discountStartDate');
            $table->date('discountEndDate')->nullable();
            $table->string('discountStatus');
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
        Schema::dropIfExists('automatic_discounts');
    }
}
