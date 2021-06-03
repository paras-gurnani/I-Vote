<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoverImageToCandidate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            //
            $table->string('cover_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            //
            $table->dropColumn('cover_image');
        });
    }
}
