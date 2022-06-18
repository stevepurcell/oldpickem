<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['race_id', 'position', 'driver_id'];

    public function race() {
        return $this->belongsTo('App\Race');
    }
    
    public function driver() {
        return $this->belongsTo('App\Driver');
    }
}
