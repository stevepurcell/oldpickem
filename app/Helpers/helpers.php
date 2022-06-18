<?php

use App\Result;
use App\Pick;
use App\Race;
use App\Driver;
use App\User;
use App\Constructor;

if (! function_exists('getDriversAge')) {
    function getDriversAge($driverID) {
        $driver = Driver::where('id', $driverID)->first();
        $birthYear = $driver['birth_year'];
        $currentYear = now()->year;
        return $currentYear - $birthYear;
    }
}

if (! function_exists('returnPoints')) {
    function returnPoints($id)
    {
        $results = Result::where('driver_id', $id)->get();
        $points = 0;
        foreach($results as $result) {

            if(($result->position > 0) && ($result->position <= 10)) {

                if(fastestLap($result->race_id, $id))
                {
                    $points = $points + 1;
                }

                $points = $points + calcPoints($result->position);
            }
        }
        return $points;
    }
}

if (! function_exists('fastestLapInd')) {
    function fastestLapInd($race_id, $driver_id)
    {
        if(fastestLap($race_id, $driver_id))
            return "*";
    }
}

if (! function_exists('fastestLap')) {
    function fastestLap($race_id, $driver_id)
    {
        $pos = 0;
        $fastestlap = \App\Result::where('race_id',$race_id)
            ->where('position', $pos)->first();

            if($fastestlap['driver_id'] == $driver_id) {
                return 1;
            }
    }
}

if (! function_exists('calcPoints')) {
    function calcPoints($position)
    {
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

if (! function_exists('getRole')) {
    function getRole($id)
    {
        $user = User::where('id', $id)->first();
        $role = $user->is_admin;
        if($role == 1) {
            return "administrator";
        } else {
            return "user";
        }
    }
}

if (! function_exists('chkPicksEntered')) {
    function chkPicksEntered($userID, $raceID) {
        $pickCount = Pick::where(['user_id', $userID], ['race_id', $raceID])->count();
        if($pickCount == 10) {
            return 1;
        } else {
            return 0;
        }
    }
}

if (! function_exists('add2Log')) {
    function add2Log($message) {
        \LogActivity::addToLog($message);
    }
}

if (! function_exists('getUserName)')) {
    function getUserName($id) {
        $user = User::findOrFail($id);
        return $user->name;
    }
}

if (! function_exists('getBadgeColor)')) {
    function getBadgeColor($id) {
        if($id == "POST") {
            return "badge-primary";
        } elseif ($id == "GET") {
            return "badge-success";
        } elseif ($id == "DELETE") {
            return "badge-danger";
        } elseif ($id == "PUT") {
            return "badge-warning";
        } else {
            return "badge-dark";
        }
    }
}

if (! function_exists('daysToRace)')) {
    function daysToRace($id) {
        // $race = Race::findOrFail($id);
        // if($race->racedate->greaterThan(date())){
        //     return "UPCOMING";
        // } else {
        //     return "PAST";
        // }
        return 1;
    }
}

if (! function_exists('getAdminStatus')) {
    function getAdminStatus($user_id) {
        $user = User::where('id', $user_id)->first();
        return $user->is_admin;
    }
}


if (! function_exists('getDriverName')) {
    function getDriverName($driver_id) {
        $driver = Driver::where('id', $driver_id)->first();
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
        $actual = Result::where('race_id', $raceid)
                        ->where('driver_id', $driverid)
                        ->where('position', '>', 0)
                        ->first();
        if($actual) {
            return $actual['position'];
        } else {
            return 99;
        }

    }
}


if (! function_exists('getPickAtPosition')) {
    function getPickAtPosition($raceid, $userid, $position) {
        $pickPos = Pick::where('race_id', $raceid)->where('position', $position)->where('user_id', $userid)->first();
        $position = $pickPos->position;
        //dd($pickPos->driver_id);
        return $pickPos->driver_id;
    }
}

if (! function_exists('getPlayerPtsByPosition')) {
    function getPlayerPtsByPosition($raceid, $userid, $position) {
        if(picksEntered($raceid, $userid)) {

                $pickDriver = getPickAtPosition($raceid, $userid, $position);
                $actualPos = getActualPosition($raceid, $pickDriver);
                $diff = abs($position - $actualPos);
//dd($diff);
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

if (! function_exists('getPlayerPtsByRace')) {
    function getPlayerPtsByRace($raceid, $userid) {
        if(picksEntered($raceid, $userid)) {
            $totalPts = 0;
            for($x = 1; $x <= 10; $x++)
            {
                $pts = getPlayerPtsByPosition($raceid, $userid, $x);
                $totalPts += $pts;
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
        $totalPts = 0;
        if(picksEntered($raceid, $userid))
        {
            for($x = 1; $x <= 10; $x++)
            {
                $pickDriver = getPickAtPosition($raceid, $userid, $x);
                $actualPos = getActualPosition($raceid, $pickDriver);
                $diff = 0;
                $points = 0;
                $driverName = getDriverName($pickDriver);

                if($actualPos > 10)
                {
                    $totalPts = $totalPts + 0;
                    $diff = 99;
                } else {
                    //$diff = abs($pickDriver - $actualPos);
                    $diff = abs($x - $actualPos);
                    $points = 10 - $diff;
                    $totalPts = $totalPts + $points;
                }
            }
        }
        return $totalPts;
    }
}

if (! function_exists('getPlayerPtsTotal')) {
    function getPlayerPtsTotal($userid) {
        $totalPts = 0;
        $races = Race::where('complete', '=', 1)->get();
        foreach($races as $race)
        {
            $points = getPlayerPts($race->id, $userid);
            $totalPts += $points;
            //dump($points);
        }
        return $totalPts;
    }
}

if (! function_exists('calcPlayerPtsByPos')) {
    function calcPlayerPtsByPos($pickPos, $actualPos) {
            $diff = 0;
            $points = 0;
        if($actualPos > 10)
        {
            return 0;
        } else {
            $diff = abs($pickPos - $actualPos);
            return 10 - $diff;
        }
    }
}


if (! function_exists('raceStarted')) {
    function raceStarted($raceid) {
        $raceDate = Race::where('id', $raceid)->first();
        if (Carbon\Carbon::now()->gte($raceDate->racedate)) {
            return 1;
        } else {
            return 0;
        }
    }
}

if (! function_exists('getPlayersPointsByWeek')) {
    function getPlayersPointsByWeek($user_id)
    {
        $races = Race::where('complete', '=', 1)->orderBy('racedate', 'asc')->get();
        $races->transform(function($races) use($user_id) {
            return ['name' => $races->name,
                    'points' => getPlayerPts($races->id, $user_id)];
        });
        $races = $races->sortByDesc('racedate');
        return $races;
    }
}

if (! function_exists('getPlayersWeeklyStandings')) {
    function getPlayersWeeklyStandings($race_id)
    {
        $standings = User::whereNull('is_admin')->get();
        $standings->transform(function($standings) use($race_id) {
            return ['name' => $standings->name,
                    'points' => getPlayerPts($race_id, $standings->id)];
        });
        $standings = $standings->sortByDesc('points');
        return $standings;
    }
}

if (! function_exists('getPlayerStandings')) {
    function getPlayerStandings()
    {
        $players = User::whereNull('is_admin')->get();
        $players->transform(function($players) {
            return ['id' => $players->id,
                    'name' => $players->name,
                    'points' => getPlayerPtsTotal($players->id)];
        });
        $players = $players->sortByDesc('points');
        return $players;
    }
}

if (! function_exists('getDriverStandings')) {
    function getDriverStandings()
    {
        $drivers = Driver::orderBy('name', 'asc')->get();
        $drivers->transform(function($drivers) {
            return ['id' => $drivers->id,
                    'name' => $drivers->name,
                    'points' => returnPoints($drivers->id)];
        });
        $drivers = $drivers->sortByDesc('points');
        return $drivers;
    }
}
