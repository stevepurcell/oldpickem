php<?
use App\Result;
use App\Pick;
use App\Race;
use App\Driver;
use App\Fastlap;

if (! function_exists('returnPoints')) {
    function returnPoints($driverid) {
        $results = Result::where('driver_id', $driverid)->get();
        $points = 0;
        foreach($results as $result) {
            if($result->position <= 10) {
                $points = $points + getPoints($result->position);
            }
        }
        return $points;
    }
}

if (! function_exists('getPoints')) {
    function getPoints($position) {
        if($position == 1) {
            $pts = 25;
        } elseif ($position == 2) {
            $pts = 18;
        } elseif ($position == 3) {
            $pts = 15;
        } elseif ($position == 4) {
            $pts = 12;
        } elseif ($position == 5) {
            $pts = 10;
        } elseif ($position == 6) {
            $pts = 8;
        } elseif ($position == 7) {
            $pts = 6;
        } elseif ($position == 8) {
            $pts = 4;
        } elseif ($position == 9) {
            $pts = 2;
        } elseif ($position == 10) {
            $pts = 1;
        } else {
            $pts = 0;
        }
        return $pts;
    }
}

if (! function_exists('pre_r')) {
    function pre_r($array) {
        //
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
}

if (! function_exists('fastestLap')) {
    function fastestLap($driverid, $raceid) {
        $fastest = Fastlap::where('race_id', $raceid)->where('driver_id', $driverid);
        if($fastest) {
            return $fastest->driver_id;
        } else {
            return "";
        }
    }
}


if (! function_exists('getDriver')) {
    function getDriver($driverid) {
        $driver = Driver::where('driver_id', $driver_id)->get();
        return $driver->name;
    }
}

if (! function_exists('getRaceName')) {
    function getRaceName($raceid) {
        $raceName = Race::where('id', $raceid)->first();
        return $raceName->name;
    }
}

if (! function_exists('raceWinner')) {
    function raceWinner($raceid) {
        $winner = Result::where('race_id', $raceid)->where('position', 1)->first();
        $winnerName = getDriver($winner->name);
        return $winnerName;
    }
}

// Calculating points for a player
// Loop through positions
// Get pick for position x
// Get actual for position x
// Get absolute value of actual - pick
// Subtract that value from 10 which will be points for that position

// Returns actual finishing position given raceid and driverid
if (! function_exists('getActualPosition')) {
    function getActualPosition($raceid, $driverid) {
        $actual = Result::where('race_id', $raceid)->where('driver_id', $driverid)->first();
        return $actual['position'];
    }
}


if (! function_exists('getPickAtPosition')) {
    function getPickAtPosition($raceid, $userid, $position) {
        $pickPos = Pick::where('race_id', $raceid)->where('position', $position)->where('user_id', $userid)->first();
        //$position = $pick->position;
        return $pickPos['driver_id'];
    }
}

if (! function_exists('getPlayerPtsByPosition')) {
    function getPlayerPtsByPosition($raceid, $userid, $position) {
        if(picksEntered($raceid, $userid)) {

                $pickDriver = getPickAtPosition($raceid, $userid, $position);
                $actualPos = getActualPosition($raceid, $pickDriver);
                $diff = abs($position - $actualPos);

                if($diff > 10)
                {
                    $points = 0;
                } else {
                    $points = 10 - $diff;
                }

                return $points;
            }
        }
    }

if (! function_exists('getDriversAge')) {
    function getDriversAge($driverID) {
        $driver = Driver::where('id', $driverID)->first();
        $birthYear = $driver['birth_year'];
        $currentYear = now()->year;
        return $currentYear - $birthYear;
    }
}

if (! function_exists('getPlayerPtsByRace')) {
    function getPlayerPtsByRace($raceid, $userid) {
        if(picksEntered($raceid, $userid)) {
            $totalPts = 0;
            for($x = 1; $x <= 10; $x++)
            {
                $totalPts += getPlayerPtsByPosition($raceid, $userid, $x);

                //debug("Race: $raceid Driver: $pickDriver Position: $x  Actual: $actualPos Diff: $diff Points: $points Total: $totalPts");
                //error_log($points);
            }
            return $totalPts;
        } else {
            return 0;
        }
    }
}

if (! function_exists('picksEntered')) {
    function picksEntered($raceid, $userid) {
        $pickCount = Pick::where('race_id', $raceid)->where('user_id', $userid)->count();

        if($pickCount > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}

if (! function_exists('raceComplete')) {
    function raceComplete($raceid) {
        $resultCount = Result::where('race_id', $raceid)->count();

        if($resultCount >= 20) {
            return 1;
        } else {
            return 0;
        }
    }
}


if (! function_exists('getPlayerPts')) {
    function getPlayerPts($raceid, $userid) {
        for($x = 1; $x <= 10; $x++)
        {
            $pickDriver = getPickAtPosition($raceid, $userid, $x);
            $actualPos = getActualPosition($raceid, $pickDriver);
            $diff = abs($x - $actualPos);

            if($diff > 10)
            {
                $points = 0;
            } else {
                $points = 10 - $diff;
            }

            $totalPts += $points;

            debug("Race: $raceid Driver: $pickDriver Position: $x  Actual: $actualPos Diff: $diff Points: $points Total: $totalPts");
            //error_log($points);
        }
        return $totalPts;
    }
}
