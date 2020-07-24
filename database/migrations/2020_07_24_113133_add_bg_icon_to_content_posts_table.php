<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBgIconToContentPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_posts', function (Blueprint $table) {
            $table->string('icon')->nullable()->after('images');
            $table->string('bg_color')->nullable()->after('video');
            $table->boolean('button')->default(false)->after('bg_color');
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
            $table->dropColumn('icon');
            $table->dropColumn('bg_color');
            $table->dropColumn('button');
        });
    }
}
