<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('is_sort')->default(0);
            $table->integer('type')->default(0);
            $table->tinyInteger('is_required')->default(0);
            $table->tinyInteger('is_placeholder')->default(0);
            $table->string('value')->nullable();
            $table->string('valueEn')->nullable();
            $table->string('data')->nullable();
            $table->string('dataEn')->nullable();
            $table->string('placeholder')->nullable();
            $table->string('placeholderEn')->nullable();
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
        Schema::dropIfExists('setting_forms');
    }
}
