<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class candidate extends Model
{
    //
public $fillable = ['desc','field','cover_image','user_id'];

    public function election(){
        return $this -> belongsTo('App\election');
    }

    public $timestamps = false;
}
