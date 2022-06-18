<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pick;
use App\User;
use App\Result;
use App\Driver;

class ReportController extends Controller
{
    
    public function index()
    {
        $drivers = getDriverStandings();
        $constructors = getConstructorStandings();
        $players = getPlayerStandings();
        return view('reports.index', compact('drivers', 'constructors', 'players'));
    }

    public function pickreport($user_id, $race_id)
    {
        // Go to the model and get a group of records
        $picks = Pick::where('user_id', $user_id)
            ->where('race_id', $race_id)
            ->where('position', '>', 0)
            ->orderBy('position', 'asc')->get();
        return view('reports.index', compact('picks'));
    }

    public function driver($driver_id)
    {
        // Go to the model and get a group of records
        $results = Result::where('driver_id', $driver_id)
            ->where('position', '>', 0)
            ->orderBy('race_id', 'asc')->get();
        return view('reports.driver', compact('results', 'driver_id'));
    }
    
    public function constructor($constructor_id)
    {
        $results = getConstructorPointsByWeek($constructor_id);
        return view('reports.constructor', compact('results', 'constructor_id'));
    }
    
    public function player($user_id)
    { 
        // Go to the model and get a group of records
        $results = getPlayersPointsByWeek($user_id);
        return view('reports.player', compact('results', 'user_id'));
    }
}
