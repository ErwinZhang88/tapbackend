<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShortdescToContentPostTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('content_post_translations', function (Blueprint $table) {
            $table->text('short_desc')->nullable()->after('nicename');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_post_translations', function (Blueprint $table) {
            $table->dropColumn('short_desc');
        });
    }
}
