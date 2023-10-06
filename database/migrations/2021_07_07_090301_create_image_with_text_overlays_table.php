<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageWithTextOverlaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_with_text_overlays', function (Blueprint $table) {
            $table->id();
			$table->string('banner_img');
			$table->text('banner_text');
			$table->string('bannerBtn_text')->nullable();
			$table->string('bannerBtn_link')->nullable();
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
        Schema::dropIfExists('image_with_text_overlays');
    }
}
