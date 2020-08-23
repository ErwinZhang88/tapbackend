<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_homes', function (Blueprint $table) {
            $table->id();
            $table->string('key')->nullable();
            $table->integer('type')->default(0);
            $table->string('display_name')->nullable();
            $table->tinyInteger('menu_id')->default(0);
            $table->string('value')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_homes');
    }
}
