<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageMobileToContentPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_posts', function (Blueprint $table) {
            $table->string('image_mobile')->nullable()->after('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_posts', function (Blueprint $table) {
            $table->dropColumn('image_mobile');
        });
    }
}
