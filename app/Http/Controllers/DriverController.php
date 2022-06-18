<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DriverRequest;
use App\Country;
use App\Constructor;
use App\Driver;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Go to the model and get a group of records
        $drivers = Driver::orderBy('name', 'asc')->paginate(10);

        // return the view and pass it to the view to be looped through
        return view('drivers.index')->with('drivers', $drivers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();
        $constructors = Constructor::get();
        return view('drivers.create')->with([
            'countries' => $countries,
            'constructors' => $constructors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DriverRequest $request)
    {
        //$driver = Driver::create($request->validated());

        // Validate form date
        $this->validate($request, [
            'name' => 'required | max:255',
        ]);

        // Process data and submit
        $driver = new Driver();
        $driver->name = $request->name;
        $driver->abbr = $request->abbr;
        $driver->country_id = $request->country_id;
        $driver->constructor_id = $request->constructor_id;
        $driver->number = $request->number;
        $driver->birthyear = $request->birthyear;
        $driver->driver_img = $request->driver_img;

        // If successful, redirect to show method
        if($driver->save()) {
            return redirect()->route('drivers.index')->with('success' , 'Driver created successfully');;
        } else {
            return redirect()->route('drivers.create')->with('error' , 'Error creating Driver');;
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
        $driver = Driver::where('id', $id)->first();
        return view('drivers.show', compact('driver'));
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
        $constructors = Constructor::get();
        $driver = Driver::findOrFail($id);
        return view('drivers.edit', compact('driver', 'countries', 'constructors'));
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
        $driver = Driver::findOrFail($id);
        $driver->update($input);
        if($driver) {
            return redirect()->route('drivers.index')
                ->with('success' , 'Driver updated successfully');
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
        $driver = Driver::findOrFail($id);
        $driver->delete();
        return redirect('/admin/drivers');
    }

    public function trash() {
        $trashedDrivers = Driver::onlyTrashed()->get();
        return view('drivers.trash', compact('trashedDrivers'));
    }

    public function restore($id) {
        $restoredDriver = Driver::onlyTrashed()->findOrFail($id);
        $restoredDriver->restore($restoredDriver);
        return redirect('/admin/drivers');
    }

    public function permanentDelete($id) {
        $permanentDeleteDriver = Driver::onlyTrashed()->findOrFail($id);
        $permanentDeleteDriver->forceDelete($permanentDeleteDriver);
        return redirect('/admin/drivers');
    }
}
