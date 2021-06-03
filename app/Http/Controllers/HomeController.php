<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\election;
use Illuminate\Support\Facades\Auth;

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
        $current_date = (int)date('Y');
        $elections = election::where([['year', $current_date]])->get();
        $current_day = (int)date('d');
        $current_month=(int)date('m');
        $st_time = (strtotime($elections[0]->st_time));
        $end_time = (strtotime($elections[0]->end_time));
        $curr_time = time();
        $status = Auth::user()->status;
        
        if(count($elections)==0){
            return view('home')->with('elections',$elections)->with('days',-3);
        }
        
        else{
            $election_time = $elections[0]->st_time;
            $election_month=explode('-',$election_time);
            $election_day = explode(' ',$election_month[2])[0];
            $election_day = (int)$election_day;
            $election_month = (int)$election_month[1];
            $diff=abs($election_day - $current_day);
            if($current_month>$election_month){
                        // -1 for election passed away
                        return view('home')->with('elections',$elections)->with('days',-1);
                    }
            elseif ($current_month<$election_month) {
                //-2 for election in upcoming months
                return view('home')->with('elections',$elections)->with('days',-2);
            }
            elseif($current_month==$election_month){
                if($diff<=10){
                                if($curr_time>=$st_time && $curr_time<=$end_time){
                                    // dd('elections started');
                                   return view('home')->with('elections',$elections)->with('days',100); 
                                }
                                return view('home')->with('elections',$elections)->with('days',$diff);
                            }
                            else{
                                // -4 for same month but more than 10 days
                                return view('home')->with('elections',$elections)->with('days',-4);
                            }
            }
        }
        
    }
}
