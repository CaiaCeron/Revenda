<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public $timestamps = false;
    
    public function proposta() {
        return $this->belongsTo('App\Proposta');
    }
}
