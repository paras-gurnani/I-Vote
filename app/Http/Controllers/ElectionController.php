<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\election;
use App\candidate;
use App\User;
use App\Candidate_count;
use App\student_status;
// use App\Http\Controllers\Auth;
use PhpParser\Node\Stmt\Foreach_;

class ElectionController extends Controller
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('elections.create');
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
        $election = new election();
        $fields=['CR','MC','CC','SR','SC'];
        // $prev_election = election::where(['year', ((int)date('Y')-1)])->get();
        // dd($prev_election);
        // dd($request);
        $arr=[$request->Class_Representative,$request->Music_Council,$request->Cultural_Council,$request->SORT_Representative,$request->Sports_Council];
        // dd($arr);
        $full_fields = ['Class Representative','Music Council','Cultural Council', 'SORT Representative','Sports Council'];
        for ($i=0; $i < 5; $i++) { 
            # code...
            if($fields[$i] == $arr[$i]){
                $election = new election();
                $election->st_time = $request->StartDate.' '.$request->StartTime;
                $election->end_time = $request->EndDate . ' ' . $request->EndTime;
                $election->field = $full_fields[$i];
                $election->total_students=0;
                $election->voting_count=0;
                $year=explode('-',$request->StartDate);
                $election->year = $year[0];
                // if (isset($prev_election)) {
                //     $election->election_group = $prev_election->election_group + 1;
                // }
                $election->save();

            }
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
        //
        $user_id = Auth::user()->id;
        $dynamic_fields = [];
        $current_date = (int)date('Y');
        $elections = election::where([['year', $current_date]])->get();
        $curr_student_status = student_status::where([['election_id',$elections[0]->election_id],['user_id',$user_id]])->get();
        // $curr_student_status = $curr_student_status[0]->status;
        if(count($curr_student_status)!=0){
            return view('elections.index')->with('fields',null)->with('candidates',null)->with('status',0);
        }
        if(count($elections)==0){
            return view('elections.notfound');
        }
        foreach ($elections as $election) {
            array_push($dynamic_fields, $election->field);
        }
        // dd($dynamic_fields);
        $all_candidates = [];
        // dd($dynamic_fields);
        foreach ($dynamic_fields as $field) {
            $candidate_field = [];
            $candidates = candidate::where([['year', $current_date], ['field', $field]])->get();
            foreach ($candidates as $candidate) {
                $user = User::where([['id',$candidate->user_id]])->get();
                $candidate->name = $user[0]->name;
                array_push($candidate_field, $candidate);
            }
            array_push($all_candidates, $candidate_field);
        } 
        return view('elections.index')->with('fields', $dynamic_fields)->with('candidates', $all_candidates)->with('status',1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $election = election::where('election_group','=',$id)->get();
        dd($election);
        return view('election.edit')->with('election',$election);
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
        //
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

    public function vote(Request $request)
    {
        $data = ($request->all());
        // dd($data);
        $i=0;
        foreach ($data as $cand_id) {
            # code...
            if($i==0){
                $i=1;
                continue;
            }
            // dd($eachdata);
            $cand_count = Candidate_count::where('candidate_id',$cand_id)->get();
            $current_candidate = candidate::where('id',$cand_id)->get();
            $current_candidate = $current_candidate[0];
            if(count($cand_count)==0){
                $candidate_count = new Candidate_count();
                $candidate_count->candidate_id = $current_candidate->id;
                $candidate_count -> election_id = $current_candidate->election_id;
                $candidate_count->vote_count = 0;
                $candidate_count->save();
            }
            else{
                $cand_count = $cand_count[0];
                $cand_count->vote_count = $cand_count->vote_count+1;
                $cand_count->save();
            }
            $stud_status = new student_status();
            $stud_status->user_id = Auth::user()->id;
            $stud_status->election_id = $current_candidate->election_id;
            $stud_status->status = 1;
            $stud_status->save();
            return view('elections.index')->with('fields', null)->with('candidates', null)->with('status',0);
        }
    }
}
