<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class student_status extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\User');   
    }

    public $timestamps = false;
}
