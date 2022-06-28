<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ExperienceController extends Controller
{
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $experience = new Experience;
        $experience->position = $request->position;
        $experience->workplace = $request->workplace;
        $experience->startyear = $request->startyear;
        if($request->filled('endyear')) {
            $experience->endyear = $request->endyear;
        }

        $id = Auth::id();
        $experience->userid = $id;
        $experience->save();

        $user = Auth::user();
        $id = Auth::id();
        $data = DB::table('users')->select('userid', 'firstname', 'surname', 'email', 'has_company')->where('userid', '=', $id)->first();

        $education = DB::table('education')->join('users', 'education.userid', '=', 'users.userid')
        ->select('eduid', 'institution', 'startyear', 'endyear', 'program')->where('education.userid', '=', $id)->get();

        $experience = DB::table('experience')->join('users', 'users.userid', '=', 'experience.userid')
        ->select('expid', 'workplace', 'startyear', 'endyear', 'position')->where('experience.userid', '=', $id)->get();

        $temp = User::find(Auth::id());
        if($temp->userrole == 2) {
            $userrole = $temp->userrole;
            return view('user_profile', compact('data', 'education', 'experience', 'userrole'));
        }
        return view('user_profile', compact('data', 'education', 'experience'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exp= DB::table('experience')->select('userid', 'expid', 'workplace', 'position', 'startyear', 'endyear')->where('expid', '=', $id)->first();

        if(Auth::id() != $exp->userid && !Gate::allows('isAdmin', auth()->user())) {
            abort(403);
        }

        return view('edit_experience', compact('exp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'workplace' => ['nullable', 'max:50'],
            'position' => ['nullable', 'max:50'],
            'startyear' => ['nullable', 'integer', 'between:1980,2022'],
            'endyear' => ['nullable', 'integer', 'between:1980,2022']
        ];

        $request->validate($rules);
        $exp = Experience::find($request->expid);
        $userid = $exp->userid;
        if(Auth::id() != $exp->userid && !Gate::allows('isAdmin', auth()->user())) {
            abort(403);
        }

        
        if(filled($request->workplace)) $exp->workplace = $request->workplace;
        if(filled($request->position)) $exp->position = $request->position;
        if(filled($request->startyear)) $exp->startyear = $request->startyear;
        if(filled($request->endyear)) $exp->endyear = $request->endyear;
        $exp->save();

        $data = DB::table('users')->select('userid', 'firstname', 'surname', 'email')->where('userid', '=', $userid)->first();

        $education = DB::table('education')->join('users', 'education.userid', '=', 'users.userid')
        ->select('eduid', 'institution', 'startyear', 'endyear', 'program')->where('education.userid', '=', $userid)->get();

        $experience = DB::table('experience')->join('users', 'users.userid', '=', 'experience.userid')
        ->select('expid', 'workplace', 'startyear', 'endyear', 'position')->where('experience.userid', '=', $userid)->get();

        $temp = User::find(Auth::id());
        if($temp->userrole == 2 && Auth::id() != $userid) {
            
            return redirect()->route('admin.showuser', $userid);

        }
        return view('user_profile', compact('data', 'education', 'experience'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $userid = DB::table('experience')->select('userid')->where('expid', '=', $id)->first();
        Experience::destroy($id);

        $data = DB::table('users')->select('userid', 'firstname', 'surname', 'email')->where('userid', '=', $userid->userid)->first();

        $education = DB::table('education')->join('users', 'education.userid', '=', 'users.userid')
        ->select('eduid', 'institution', 'startyear', 'endyear', 'program')->where('education.userid', '=', $userid->userid)->get();

        $experience = DB::table('experience')->join('users', 'users.userid', '=', 'experience.userid')
        ->select('expid', 'workplace', 'startyear', 'endyear', 'position')->where('experience.userid', '=', $userid->userid)->get();

        $temp = User::find(Auth::id());
        if($temp->userrole == 2 && Auth::id() != $userid->userid) {
            return redirect()->route('admin.showuser', $userid->userid);
        }
        return view('user_profile', compact('data', 'education', 'experience'));
    }
}
