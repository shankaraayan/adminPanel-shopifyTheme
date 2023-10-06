<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_category');
			$table->string('product_subCategory')->nullable();
            $table->string('product_name');
            $table->string('product_url');
			$table->string('product_pic1');
            $table->string('product_pic2')->nullable();
            $table->string('product_pic3')->nullable();
            $table->string('product_pic4')->nullable();
			$table->integer('product_totalPrice')->nullable();
            $table->integer('product_price');
            $table->string('price_filter');
			$table->string('product_code');
			$table->integer('product_quantity')->default(0);
			$table->string('product_hasVariants')->nullable();
			$table->string('product_variantType')->nullable();
			$table->string('product_variant1')->nullable();
			$table->string('product_variant2')->nullable();
			$table->string('product_variant3')->nullable();
			$table->string('product_variant4')->nullable();
			$table->string('product_variant5')->nullable();
			$table->string('product_variant1sku')->nullable();
			$table->string('product_variant2sku')->nullable();
			$table->string('product_variant3sku')->nullable();
			$table->string('product_variant4sku')->nullable();
			$table->string('product_variant5sku')->nullable();
			$table->integer('product_variant1qty')->default(0);
			$table->integer('product_variant2qty')->default(0);
			$table->integer('product_variant3qty')->default(0);
			$table->integer('product_variant4qty')->default(0);
			$table->integer('product_variant5qty')->default(0);
			$table->integer('product_variant1cost')->default(0);
			$table->integer('product_variant2cost')->default(0);
			$table->integer('product_variant3cost')->default(0);
			$table->integer('product_variant4cost')->default(0);
			$table->integer('product_variant5cost')->default(0);
			$table->integer('product_variant1mrp')->default(0);
			$table->integer('product_variant2mrp')->default(0);
			$table->integer('product_variant3mrp')->default(0);
			$table->integer('product_variant4mrp')->default(0);
			$table->integer('product_variant5mrp')->default(0);
			$table->text('product_description')->nullable();
			$table->text('product_ingredients')->nullable();
			$table->text('product_nutritionalFacts')->nullable();
			$table->text('product_benefits')->nullable();
			$table->text('product_otherInfo')->nullable();
			$table->string('product_healthBenefit');
			$table->string('product_discountType')->nullable();
			$table->integer('product_discountValue')->default(0);
            $table->string('product_status');
            $table->bigInteger('product_most-viewed');
            $table->bigInteger('product_bestsellers');
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
        Schema::dropIfExists('products');
    }
}
