<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Constructor extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'country_id', 'teamchief', 'technicalchief', 'chassis', 'powerunit', 'constructor_img'];
     
    public function driver() {
        return $this->hasMany('App\Driver');
    }
    
    public function country() {
        return $this->belongsTo('App\Country');
    }
    
}
