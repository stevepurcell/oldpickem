<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Race extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'racedate', 'completed', 'track_id'];

    public function track() {
        return $this->belongsTo('App\Track');
    }
}
