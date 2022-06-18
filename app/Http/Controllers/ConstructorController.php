<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Constructor;

class ConstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Go to the model and get a group of records
        $constructors = Constructor::orderBy('name', 'asc')->paginate(10);

        // return the view and pass it to the view to be looped through
        return view('constructors.index')->with('constructors', $constructors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();
        return view('constructors.create', compact('countries'));
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
        ]);

        // Process data and submit
        $constructor = new Constructor();
        $constructor->name = $request->name;
        $constructor->country_id = $request->country_id;
        $constructor->teamchief = $request->teamchief;
        $constructor->technicalchief = $request->technicalchief;
        $constructor->chassis = $request->chassis;
        $constructor->powerunit = $request->powerunit;
        

        // If successful, redirect to show method
        if($constructor->save()) {
            return redirect()->route('constructors.index')->with('success' , 'Constructor created successfully');;
        } else {
            return redirect()->route('constructors.create')->with('error' , 'Error creating Constructor');;
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
        $constructor = Constructor::where('id', $id)->first();
        return view('constructors.show', compact('constructor'));
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
        $constructor = Constructor::findOrFail($id);
        return view('constructors.edit', compact('constructor', 'countries'));
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
        $constructor = Constructor::findOrFail($id);
        $constructor->update($input);
        if($constructor) {
            return redirect()->route('constructors.index')
                ->with('success' , 'Constructor updated successfully');
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
        $constructor = Constructor::findOrFail($id);
        $constructor->delete();
        return redirect('/admin/constructors');
    }

    public function trash() {
        $trashedConstructors = Constructor::onlyTrashed()->get();
        return view('constructors.trash', compact('trashedConstructors'));
    }
    
    public function restore($id) {
        $restoredConstructor = Constructor::onlyTrashed()->findOrFail($id);
        $restoredConstructor->restore($restoredConstructor);
        return redirect('/admin/constructors');
    }
    
    public function permanentDelete($id) {
        $permanentDeleteConstructor = Constructor::onlyTrashed()->findOrFail($id);
        $permanentDeleteConstructor->forceDelete($permanentDeleteConstructor);
        return redirect('/admin/constructors');
    }
}
