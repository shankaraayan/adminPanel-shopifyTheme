<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Filters;

class CreateFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filters', function (Blueprint $table) {
            $table->id();
            $table->string('filter_value');
            $table->string('filter_type');
            $table->timestamps();
        });
		
		Filters::create([
		    'filter_value' => 'Newest',
		    'filter_type' => 'sorting'
		]);
		Filters::create([
		    'filter_value' => 'Price Lowest',
		    'filter_type' => 'sorting'
		]);
		Filters::create([
		    'filter_value' => 'Price Highest',
		    'filter_type' => 'sorting'
		]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filters');
    }
}
