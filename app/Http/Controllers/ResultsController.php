<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Race;
use App\Driver;
use App\Result;

class ResultsController extends Controller
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
        return view('results.index', compact('races'));
    }

    public function create()
    {
        $race = Race::findOrFail($id);
        $drivers = Driver::orderBy('name', 'asc')->get();
        return view('results.create', compact('race', 'drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $race = Race::findOrFail($id);
        $drivers = Driver::orderBy('name', 'asc')->get();
        return view('results.create', compact('race', 'drivers'));
    }

    public function enterResults($id)
    {
        $race = Race::findOrFail($id);
        $drivers = Driver::orderBy('name', 'asc')->get();
        return view('results.create', compact('race', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form date
        // $this->validate($request, [
        //     'race_id' => 'required',
        // ]);
        //dd($request);
        // Process data and submit

        $errcount = 0;

        for($x=0; $x <= 20; $x++) {
            $results = new Result();
            $results->race_id = $request->race_id;
            $results->driver_id = $request['pos'.$x];
            $results->position = $x;

            // If successful, redirect to show method
            if(!$results->save()) {
                $errcount = $errcount + 1;
            }
        }



        if($errcount < 1) {
            $complete = 1;
            Race::where('id', $request['race_id'])->update(array(
                      'complete'=>$complete,
                     ));

                return redirect()->route('results.index')->with('success' , 'Results created successfully');;
            } else {
                return redirect()->route('results.create')->with('error' , 'Error creating Results');;
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
        $results = Result::where('race_id', $id)->where('position', '>', 0)->get();
        $race = Race::where('id', $id)->first();

        //dd($results);
        return view('results.show', compact('results', 'race'));
    }

    public function singleResults($id)
    {
return "Results Single";
        $results = Result::where('race_id', $id)->get();
        $picks = Pick::where('race_id', $id)->get();
        return view('results.single', compact('results', 'picks'));
    }
}
