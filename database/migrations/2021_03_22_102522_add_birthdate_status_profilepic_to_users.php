<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBirthdateStatusProfilepicToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table -> date('BirthDate');
            $table -> string('Status');
            $table -> string('cover_image');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            Schema::table('users', function (Blueprint $table) {
                //
                $table->dropColumn('BirthDate');
                $table->dropColumn('Status');
                $table->dropColumn('cover_image');
            });
        });
    }
}
