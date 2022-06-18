<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Race;
use App\Driver;
use App\Pick;
use App\User;

class PickController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Go to the model and get a group of records
        $races = Race::orderBy('racedate', 'asc')->get();
        return view('picks.index', compact('races'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $race = Race::findOrFail($id);
        $drivers = Driver::orderBy('name', 'asc')->get();
        return view('picks.create', compact('race', 'drivers'));
    }

    public function pick($id)
    {
        $race = Race::findOrFail($id);
        $drivers = Driver::orderBy('abbr', 'asc')->get();
        return view('picks.create', compact('race', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errcount = 0;
        $user_id = \Auth::user()->id;

        for($x=0; $x <= 10; $x++) {
            $picks = new Pick();
            $picks->user_id = $user_id;
            $picks->race_id = $request->race_id;
            $picks->driver_id = $request['pos'.$x];
            $picks->position = $x;

            // If successful, redirect to show method
            if(!$picks->save()) {
                $errcount = $errcount + 1;
            }
        }

        if($errcount < 1) {
                add2Log('User added picks.');
                return redirect()->route('picks.index')->with('success' , 'Results created successfully');;
            } else {
                return redirect()->route('picks.create')->with('error' , 'Error creating Results');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $standings = getPlayersWeeklyStandings($id);
        $userid = Auth::user()->id;
        $players = User::whereNull('is_admin')->get();
        $picks = Pick::where('race_id', $id)
                    ->where('user_id', $userid)
                    ->where('position', '>', 0)
                    ->get();

        return view('picks.show', compact('picks', 'players', 'standings'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function results($id)
    {
        $userid = Auth::user()->id;
        $picks = Pick::where('race_id', $id)
                    ->where('user_id', $userid)
                    ->get();

        return view('picks.results', compact('picks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $race = Race::where('id', $id)->first();
        $drivers = Driver::get();
        $pick = Pick::where('race_id', $id)
                    ->where('user_id', Auth::id())
                    ->get();

        return view('picks.edit', compact('pick', 'drivers', 'race'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $requests = $request->all();
        $race_id = $request['race_id'];
        $user_id = Auth::user()->id;
        $errcount = 0;

        for($x=0; $x <=10; $x++) {
            if(! $pick = Pick::where('user_id', $user_id)
                        ->where('race_id', $race_id)
                        ->where('position', $x)->update([
                            "driver_id" => $request['pos'. $x]
                        ])) {
                            $errcount = $errcount + 1;
                        }
            //dump($request['pos'. $x] . "  " . $race_id . "  " . $user_id);
        }

        if($errcount < 1) {
                add2Log('User updated picks.');
                return redirect()->route('picks.index')->with('success' , 'Picks updated successfully');
            } else {
                return redirect()->route('picks.index')->with('error' , 'Error updating Picks');;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
