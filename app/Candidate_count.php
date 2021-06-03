<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate_count extends Model
{
    //
    public $fillable = ['candidate_id', 'election_id', 'vote_count'];

    public function election()
    {
        return $this->belongsTo('App\candidate');
    }

    public $timestamps = false;
}
