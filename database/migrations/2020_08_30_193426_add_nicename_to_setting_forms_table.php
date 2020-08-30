<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNicenameToSettingFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting_forms', function (Blueprint $table) {
            $table->string('nicename')->nullable()->after('placeholderEn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting_forms', function (Blueprint $table) {
            $table->dropColumn('nicename');
        });
    }
}
