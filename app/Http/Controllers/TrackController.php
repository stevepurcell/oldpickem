<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Track;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Go to the model and get a group of records
        $tracks = Track::orderBy('id', 'asc')->get();

        // return the view and pass it to the view to be looped through
        return view('tracks.index')->with('tracks', $tracks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();
        return view('tracks.create', compact('countries'));
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
            'country_id' => 'required'

        ]);

        // Process data and submit
        $track = new Track();
        $track->name = $request->name;
        $track->country_id = $request->country_id;


        // If successful, redirect to show method
        if($track->save()) {
            return redirect()->route('tracks.index')->with('success' , 'Track created successfully');;
        } else {
            return redirect()->route('tracks.create')->with('error' , 'Error creating Track');;
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
        $track = Track::where('id', $id)->first();
        return view('tracks.show', compact('track'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::get();
        $track = Track::findOrFail($id);
        return view('tracks.edit', compact('track', 'countries'));
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
        $track = Track::findOrFail($id);
        $track->update($input);
        if($track) {
            return redirect()->route('tracks.index')
                ->with('success' , 'Track updated successfully');
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
        $track = Track::findOrFail($id);
        $track->delete();
        return redirect('/admin/tracks');
    }

    public function trash() {
        $trashedTracks = Track::onlyTrashed()->get();
        return view('tracks.trash', compact('trashedTracks'));
    }

    public function restore($id) {
        $restoredTrack = Track::onlyTrashed()->findOrFail($id);
        $restoredTrack->restore($restoredTrack);
        return redirect('/admin/tracks');
    }

    public function permanentDelete($id) {
        $permanentDeleteTrack = Track::onlyTrashed()->findOrFail($id);
        $permanentDeleteTrack->forceDelete($permanentDeleteTrack);
        return redirect('/admin/tracks');
    }
}
