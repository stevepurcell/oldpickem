<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\LogActivity;
use App\Race;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $races = Race::orderBy('racedate', 'asc')->get();
        $standings = getPlayerStandings();
	
	// return the view and pass it to the view to be looped through
        return view('home', compact('races', 'standings'));
    }
	 /**
     * Show the application dashboard for admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        // Go to the model and get a group of records
        $races = Race::orderBy('id', 'asc')->get();
        $standings = getPlayerStandings();
        // return the view and pass it to the view to be looped through
        return view('adminHome', compact('races', 'standings'));
    }

    public function clearLogs()
    {
        logActivity::truncate();
        add2Log('Activity Logs Cleared');
        return back();
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function logActivity()
    {
        //$logs = \LogActivity::logActivityLists();
        $logs = LogActivity::orderBy('id', 'desc')->paginate(25);
        return view('logActivity',compact('logs'));
    }

    public function compose(View $view)
    {
        //$constructors = DB::table('constructors')->count();
        //Table::select('name','surname')->where('id', 1)->get();
        $race = Race::where('racedate', '>', now())->first();
        //dd($race);
        // $counts = [
        //     'constructors' => DB::table('constructors')->count(),
        //     'drivers' => DB::table('drivers')->count(),
        //     'players' => DB::table('users')->whereNull('is_admin')->count(),
        //     'races' => DB::table('races')->count(),
        //     'tracks' => DB::table('tracks')->count(),
        //     'countries' => DB::table('countries')->count(),
        // ];

        $view->with('race', $race);
    }
}
?>
