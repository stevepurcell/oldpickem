<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Go to the model and get a group of records
        $countries = Country::orderBy('id', 'asc')->paginate(100);

        // return the view and pass it to the view to be looped through
        return view('countries.index')->with('countries', $countries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('countries.create');
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
            'flag' => 'required | max:2'

        ]);

        // Process data and submit
        $country = new Country();
        $country->name = $request->name;
        $country->flag = $request->flag;
        

        // If successful, redirect to show method
        if($country->save()) {
            return redirect()->route('countries.index');
        } else {
            return redirect()->route('countries.create');
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
        $country = Country::where('id', $id)->first();
        return view('countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('countries.edit', compact('country'));
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
        $country = Country::findOrFail($id);
        $country->update($input);
        if($country) {
            return redirect()->route('countries.index')
                ->with('success' , 'Country updated successfully');
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
        $country = Country::findOrFail($id);
        $country->delete();
        return redirect('/admin/countries');
    }

    public function trash() {
        $trashedCountries = Country::onlyTrashed()->get();
        return view('countries.trash', compact('trashedCountries'));
    }
    
    public function restore($id) {
        $restoredCountry = Country::onlyTrashed()->findOrFail($id);
        $restoredCountry->restore($restoredCountry);
        return redirect('/admin/countries');
    }
    
    public function permanentDelete($id) {
        $permanentDeleteCountry = Country::onlyTrashed()->findOrFail($id);
        $permanentDeleteCountry->forceDelete($permanentDeleteCountry);
        return redirect('/admin/countries');
    }
}
