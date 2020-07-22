<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCenterLeftRightToMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->tinyInteger('left')->default(0)->after('type');
            $table->tinyInteger('center')->default(0)->after('left');
            $table->tinyInteger('right')->default(0)->after('center');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('left');
            $table->dropColumn('center');
            $table->dropColumn('right');
        });
    }
}
