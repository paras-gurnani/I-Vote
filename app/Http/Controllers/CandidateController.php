<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\candidate;
use App\election;
use App\User;
use App\Candidate_count;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Http\Request;

class CandidateController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dynamic_fields=[];
        $current_date = (int)date('Y');
        $elections = election::where([['year', $current_date]])->get();
        foreach ($elections as $election) {
            array_push($dynamic_fields,$election->field);
        }
        $all_candidates=[];

        foreach ($dynamic_fields as $field) {
            $candidate_field=[];
            $candidates = candidate::where([['year',$current_date],['field',$field]])->get();
            foreach ($candidates as $candidate) {
                $user = User::where([['id',$candidate->user_id]])->get();
                $candidate->name = $user[0]->name;
                // dd($candidate);
                array_push($candidate_field,$candidate);
            }
            array_push($all_candidates,$candidate_field);
        }
        // dd($all_candidates[0][0]);
        // $user = User::where(['']);
        return view('candidates.index')->with('fields',$dynamic_fields)->with('candidates',$all_candidates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('candidates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        // $this->validate($request, [
        //     'field' => 'required',
        //     'desc' => 'required',
        //     'cover_image' => 'image|nullable|max:1999'
        // ]);
        // return view('candidates.index');

        //File Upload
        
        if ($request->hasFile('cover_image')) {
            //Get filename with extension
            $filenamewithExt = $request->file('cover_image')->getClientOriginalName();
            //Get Just filename
            $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
            //Get only extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . '.' . $extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noname.png';
        }

        $election = new election();
        $current_date =(int)date('Y');
        $candidate = new candidate();
        
        $candidate->field = $request->field;
        // dd($request->field);
        
        $candidate->desc = $request->desc;
        // $all_elections = election::all();
        // dd($current_date);
        // dd($request->field);


        $curr_election = election::where([['year',$current_date],['field',$request->field]])->get();


        // dd($curr_election[0]->year);
        $candidate->election_id = $curr_election[0]->election_id;
        
        $candidate->user_id = Auth::user()->id;
        $candidate->name = Auth::user()->name;
        $candidate->cover_image = $fileNameToStore;
        $candidate->year = $current_date;
        // dd($candidate);
        $candidate->save();

        $candidate = candidate::where([['election_id',$curr_election[0]->election_id],['user_id',Auth::user()->id]])->get();
        // dd($candidate);
        $candidate_count = new Candidate_count();
        $candidate_count->candidate_id = $candidate[0]->id;
        $candidate_count->election_id = $curr_election[0]->election_id;
        $candidate_count->vote_count = 0;
        $candidate_count->save();

        return redirect('/candidates');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $curr_candidate = candidate::find($id);
        // dd('hello');
        return view('candidates.show')->with('candidate', $curr_candidate);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // dd($id);
        $curr_candidate = candidate::find($id);
        // dd($curr_candidate);
        return view('candidates.edit')->with('candidate',$curr_candidate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, candidate $candidate)
    {
        //

        
        if ($request->hasFile('cover_image')) {
            //Get filename with extension
            $filenamewithExt = $request->file('cover_image')->getClientOriginalName();
            //Get Just filename
            $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
            //Get only extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . '.' . $extension;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = $candidate->cover_image;
        }

        $election = new election();
        $current_date =(int)date('Y');
        $candidate->field = $request->field;
        $candidate->desc = $request->desc;
        $candidate->year = $current_date;
        // $all_elections = election::all();
        // dd($current_date);
        // dd($request->field);


        $curr_election = election::where([['year',$current_date],['field',$request->field]])->get();


        // dd($curr_election[0]->year);
        $candidate->election_id = $curr_election[0]->election_id;
        $candidate->id = Auth::user()->id;
        $candidate->cover_image = $fileNameToStore;
        // dd($candidate);
        $candidate->save();

        return redirect('/candidates')->with('success','candidate updated');
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
