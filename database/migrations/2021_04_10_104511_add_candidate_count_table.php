<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCandidateCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('candidate_count',function (Blueprint $table){
            $table->id();
            $table->foreignId('id')->references('candidate_id')->on('candidates')->cascadeOnDelete();
            $table->foreignId('election_id')->references('election_id')->on('elections')->cascadeOnDelete();
            $table->integer('vote_count');
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
        Schema::dropIfExists('candidate_count');
    }
}
