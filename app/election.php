<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\PseudoTypes\False_;

class election extends Model
{
    //

    protected $fillable = ['st_time','end_time','field','total_students','voting_count','year'];

    public function candidate(){
        return $this->hasMany('App\candidate');
    }

    public $timestamps = false;
}
