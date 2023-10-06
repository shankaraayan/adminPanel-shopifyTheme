<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\announcementBar;

class CreateAnnouncementBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_bars', function (Blueprint $table) {
            $table->id();
			$table->text('heading')->nullable();
			$table->text('description')->nullable();
			$table->string('background_color')->nullable();
			$table->string('text_color')->nullable();
            $table->timestamps();
        });
		
		announcementBar::create([
		    'heading' => '',
		    'description' => '',
		    'background_color' => '',
		    'text_color' => ''
		]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcement_bars');
    }
}
