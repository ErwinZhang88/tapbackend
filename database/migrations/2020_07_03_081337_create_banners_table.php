<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nicename')->unique();
            $table->string('nameEn')->nullable();
            $table->string('nicenameEn')->unique();
            $table->string('banner')->nullable();
			$table->unsignedInteger('type')->default(0);
			$table->unsignedInteger('type_id')->default(0);
            $table->tinyInteger('order')->default(0);
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
        Schema::dropIfExists('banners');
    }
}
