<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('student_status',function(Blueprint $table){
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('election_id')->references('election_id')->on('elections')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('status');
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
        Schema::drop('student_status');
    }
}
