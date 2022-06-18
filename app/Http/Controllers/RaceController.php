<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track;
use App\Race;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Go to the model and get a group of records
        $races = Race::orderBy('id', 'asc')->get();

        // return the view and pass it to the view to be looped through
        return view('races.index')->with('races', $races);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tracks = Track::get();
        return view('races.create', compact('tracks'));
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
        $this->validate($request, [
            'name' => 'required | max:255',
            'racedate' => 'required'

        ]);

        // Process data and submit
        $race = new Race();
        $race->racedate = $request->racedate;
        $race->name = $request->name;
        $race->complete = 0;
        $race->track_id = $request->track_id;
        

        // If successful, redirect to show method
        if($race->save()) {
            add2Log('User added picks.');
            return redirect()->route('races.index')->with('success' , 'Race created successfully');;
        } else {
            add2Log('User failed to add picks.');
            return redirect()->route('races.create')->with('error' , 'Error creating Race');;
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
        $race = Race::where('id', $id)->first();
        return view('races.show', compact('race'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tracks = Track::get();
        $race = Race::findOrFail($id);
        return view('races.edit', compact('race', 'tracks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $race = Race::findOrFail($id);
        $race->update($input);
        if($race) {
            return redirect()->route('races.index')
                ->with('success' , 'Race updated successfully');
        }
        return back()->withInput();
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

    public function delete($id) {
        $race = Race::findOrFail($id);
        $race->delete();
        return redirect('/admin/races');
    }

    public function trash() {
        $trashedRaces = Race::onlyTrashed()->get();
        return view('races.trash', compact('trashedRaces'));
    }
    
    public function restore($id) {
        $restoredRace = Race::onlyTrashed()->findOrFail($id);
        $restoredRace->restore($restoredRace);
        return redirect('/admin/races');
    }
    
    public function permanentDelete($id) {
        $permanentDeleteRace = Race::onlyTrashed()->findOrFail($id);
        $permanentDeleteRace->forceDelete($permanentDeleteRace);
        return redirect('/admin/races');
    }
}
