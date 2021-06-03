<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCandiateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::enableForeignKeyConstraints();

        Schema::create('candidates',function (Blueprint $table) {
            $table->id('candidate_id');
            // $table->bigInteger('user_id')->unsigned();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('desc');
            $table->string('field');
            // $table->bigInteger('election_id')->unsigned();
            $table->foreignId('election_id')->references('election_id')->on('elections')->cascadeOnDelete();
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
        // Schema::table('candidate',function (Blueprint $table) {
        //     $table->dropColumn('candidate_id');
        //     // $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
        //     $table->dropColumn('desc');
        //     $table->dropColumn('field');
        //     $table->dropForeign(['user_id']);
        //     $table->dropForeign(['election_id']);
        // });

        Schema::drop('candidates');
    }
}
