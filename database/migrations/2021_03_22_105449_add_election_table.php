<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddElectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('elections',function(Blueprint $table){
            $table->id('election_id');
            $table->dateTime('st_time');
            $table->dateTime('end_time');
            $table->year('year');
            $table->integer('voting_count');
            $table->integer('total_students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        // Schema::table('elections', function (Blueprint $table) {
        //     $table->dropColumn('election_id');
        //     $table->dropColumn('st_time');
        //     $table->dropColumn('end_time');
        //     $table->dropColumn('year');
        //     $table->dropColumn('voting_count');
        //     $table->dropColumn('total_students');
        // });
        Schema::drop('elections');
    }
}
