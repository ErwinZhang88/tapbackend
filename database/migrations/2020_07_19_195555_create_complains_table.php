<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nicename')->unique();
            $table->string('group')->nullable();
            $table->string('country')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('fax')->nullable();
            $table->string('keluhan_kepada')->nullable();
            $table->string('nama_responden')->nullable();
            $table->text('lokasi_keluhan')->nullable();
            $table->text('informasi_keluhan')->nullable();
            $table->text('hal_kebijakan')->nullable();
            $table->string('bukti')->nullable();
            $table->boolean('tindakan')->default(false);
            $table->text('langkah_kebijakan')->nullable();
            $table->text('metode_masalah')->nullable();
            $table->text('hasil_keluhan')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('complains');
    }
}
