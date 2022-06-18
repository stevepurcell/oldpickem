<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'abbr', 'country_id', 'constructor_id', 'number', 'birthyear', 'driver_img'];

    public function constructor() {
        return $this->belongsTo('App\Constructor');
    }

    public function country() {
        return $this->belongsTo('App\Country');
    }

}
