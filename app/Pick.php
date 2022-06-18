<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pick extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'race_id', 'position', 'driver_id'];

    public function race() {
        return $this->belongsTo('App\Race');
    }
    public function driver() {
        return $this->belongsTo('App\Driver');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }
}
