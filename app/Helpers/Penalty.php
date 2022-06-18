<?php

use App\Penalty;

if (! function_exists('getConstructorPenaltyPointsTotal')) {
    function getConstructorPenaltyPointsTotal($constructor_id) {
		$penalties = Penalty::where('entity_id', $constructor_id)
							->get();
        $points = 0;
        
        foreach($penalties as $penalty) {
			$points += $penalty->points;
		}

        return $points;
    }
}

if (! function_exists('getConstructorPenaltyPointsByRace')) {
    function getConstructorPenaltyPointsByRace($constructor_id, $race_id) {
		$penalties = Penalty::where('entity_id', $constructor_id)
							->where('race_id', $race_id)
							->get();
        $points = 0;
        
        foreach($penalties as $penalty) {
			$points += $penalty->points;
		}

        return $points;
    }
}

