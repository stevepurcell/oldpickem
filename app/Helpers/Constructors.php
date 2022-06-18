<?php

use App\Result;
use App\Pick;
use App\Race;
use App\Driver;
use App\User;
use App\Constructor;

if (! function_exists('getConstructorName')) {
    function getConstructorName($id) {
        $constructor = Constructor::where('id', $id)->first();
        return $constructor->name;
    }
}

if (! function_exists('getConstructorsDrivers')) {
    function getConstructorsDrivers($id) {
        $drivers = DB::table('drivers')
                ->select('id')
                ->where('constructor_id', '=', $id)
                ->pluck('id');
        return $drivers->toArray();
    }
}

if (! function_exists('getConstructorPoints')) {
    function getConstructorPoints($constructor_id, $race_id) {
    	$drivers = getConstructorsDrivers($constructor_id);
		$results = Result::whereIn('driver_id', $drivers)
							->where('race_id', $race_id)
							->get();
        
        $points = 0;
        
        foreach($results as $result) {
        	if(($result->position > 0) && ($result->position <= 10)) {
                if(fastestLap($result->race_id, $result->driver_id))
                {
                    $points = $points + 1;
                }
                $points = $points + calcPoints($result->position);
            }
        }
        $points = $points - getConstructorPenaltyPointsByRace($constructor_id, $race_id);
        return $points;
    }
}

if (! function_exists('getConstructorPointsTotal')) {
    function getConstructorPointsTotal($constructor_id) {
    	$drivers = getConstructorsDrivers($constructor_id);
		$results = Result::whereIn('driver_id', $drivers)->get();
        
        $points = 0;
        
        foreach($results as $result) {
        	if(($result->position > 0) && ($result->position <= 10)) {
                if(fastestLap($result->race_id, $result->driver_id))
                {
                    $points = $points + 1;
                }
                $points = $points + calcPoints($result->position);
            }
        }
        $points = $points - getConstructorPenaltyPointsTotal($constructor_id);
        return $points;
    }
}

if (! function_exists('getConstructorPointsByWeek')) {
    function getConstructorPointsByWeek($constructor_id)
    {
        $races = Race::where('complete', '=', 1)->orderBy('racedate', 'asc')->get();
        $races->transform(function($races) use($constructor_id) {
            return ['name' => $races->name, 
            		'racedate' => $races->racedate,
                    'points' => getConstructorPoints($constructor_id, $races->id)];
        });
        //$races = $races->sortByDesc('racedate');
        return $races;
    }
}

if (! function_exists('getConstructorStandings')) {
    function getConstructorStandings()
    {
        $constructors = Constructor::orderBy('name', 'asc')->get();
        $constructors->transform(function($constructors) {
            return ['id' => $constructors->id, 
                    'name' => $constructors->name, 
                    'points' => getConstructorPointsTotal($constructors->id)];
        });
        $constructors = $constructors->sortByDesc('points');
        return $constructors;
    }
}