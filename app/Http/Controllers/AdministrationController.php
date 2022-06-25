<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\JobOffer;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdministrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('isAdmin', auth()->user())) {
            $users = DB::table('users')->select('users.userid', 'companyid', 'firstname', 'surname', 'username', 'userrole', 'has_company', 'users.created_at', 'email')->leftJoin('companies', 'companies.userid', '=', 'users.userid')->where('userrole', '<>', '2')->paginate(2);
            return view('administration/admin_panel', compact('users'));
        }
        else abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);

    }

    public function storeOffer(Request $request)
    {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);

        $offer = new JobOffer;
        $offer->companyid = $request->companyid;
        $offer->position = $request->position;
        $offer->category = $request->category;
        $offer->workload = $request->workload;
        if(filled($request->salary)) $offer->salary = $request->salary;
        $offer->location = $request->location;
        $offer->description = $request->description;
        $offer->extra_info = $request->extra_info;
        $offer->posted_at = date('Y-m-d');
        $offer->save();

        $data = DB::table('companies')->select('companyid', 'users.userid', 'users.firstname', 'users.surname', 'users.created_at', 'users.email', 'name', 'registryid', 'about', 'homepage', 'location')
        ->join('users', 'users.userid', '=', 'companies.userid')->where('companyid', '=', $request->companyid)->first();

        $offers = DB::table('joboffers')->where('companyid', '=', $request->companyid)->get();
        return view('administration/admin_companyview', compact('data', 'offers'));
    }
    // return view for viewing user profile
    public function show($id)
    {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);

        $user = DB::table('users')->select('userrole', 'userid', 'firstname', 'surname', 'email', 'created_at', 'username')->where('userid', '=', $id)->first();

        $education = DB::table('education')->join('users', 'education.userid', '=', 'users.userid')
        ->select('eduid', 'institution', 'startyear', 'endyear', 'program')->where('education.userid', '=', $id)->get();

        $experience = DB::table('experience')->join('users', 'users.userid', '=', 'experience.userid')
        ->select('expid', 'workplace', 'startyear', 'endyear', 'position')->where('experience.userid', '=', $id)->get();

        return view('administration/admin_userview', compact('user', 'education', 'experience'));
    }

    // return view for viewing company data
    public function showCompany($id)
    {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);
        

        $data = DB::table('companies')->select('companyid', 'users.userid', 'users.firstname', 'users.surname', 'users.created_at', 'users.email', 'name', 'registryid', 'about', 'homepage', 'location')
        ->join('users', 'users.userid', '=', 'companies.userid')->where('companyid', '=', $id)->first();

        $offers = DB::table('joboffers')->where('companyid', '=', $id)->get();
        return view('administration/admin_companyview', compact('data', 'offers'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);
        $user = DB::table('users')->where('userid', '=', $id)->first();

        return view('administration/edit/edit_user', compact('user'));
    }

    public function editCompany($id) {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);

        $company = DB::table('companies')->where('companyid', '=', $id)->first();

        return view('administration/edit/edit_company', compact('company'));
    }
    
    public function update(Request $request)
    {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);

        $user = User::find($request->userid);
        if(filled($request->firstname)) $user->firstname = $request->firstname;
        if(filled($request->surname)) $user->surname = $request->surname;
        if(filled($request->email)) $user->email = $request->email;
        if(filled($request->newpassword)) $user->password = Hash::make($request->newpassword);
        if($request->hasFile('picture')) {
            $extension = $request->file('picture')->extension();
            $request->file('picture')->storeAs('public/avatars', $request->userid.'.jpg');
        }
        $user->save();

        return redirect()->route('admin.showuser', $request->userid);
    }

    public function updateCompany(Request $request) {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);

        $update_company = Company::find($request->companyid);
        if(filled($request->name)) $update_company->name = $request->name;
        if(filled($request->registryid)) $update_company->registryid = $request->registryid;
        if(filled($request->homepage)) $update_company->homepage = $request->homepage;
        if(filled($request->location)) $update_company->location = $request->location;
        if(filled($request->about)) $update_company->about = $request->about;
        $update_company->save();

        $update_user = User::find($request->userid);
        if(filled($request->firstname)) $update_user->firstname = $request->firstname;
        if(filled($request->surname)) $update_user->surname = $request->surname;
        if(filled($request->email)) $update_user->email = $request->email;
        if(filled($request->newpassword)) $update_user->password = Hash::make($request->newpassword);
        if($request->hasFile('picture')) {
            $extension = $request->file('picture')->extension();
            $request->file('picture')->storeAs('public/avatars', $request->userid.'.jpg');
        }
        $update_user->save();

        return redirect()->route('admin.showcompany', $request->companyid);
    }

    public function newExperience(Request $request) {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);

        $exp = new Experience;
        $exp->userid = $request->userid;
        $exp->workplace = $request->workplace;
        $exp->position = $request->position;
        $exp->startyear = $request->startyear;
        $exp->endyear = $request->endyear;
        $exp->save();

        return redirect()->route('admin.showuser', $request->userid);

    }

    public function newEducation(Request $request) {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);

        $edu = new Education;
        $edu->userid = $request->userid;
        $edu->institution = $request->institution;
        $edu->program = $request->program;
        $edu->startyear = $request->startyear;
        $edu->endyear = $request->endyear;
        $edu->save();

        return redirect()->route('admin.showuser', $request->userid);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);
        User::destroy($id);
        DB::table('experience')->where('userid', '=', $id)->delete();
        DB::table('education')->where('userid', '=', $id)->delete();
        $users = DB::table('users')->select('userid', 'firstname', 'surname', 'username', 'userrole', 'has_company', 'created_at', 'email')->where('userrole', '<>', '2')->paginate(2);
        return view('administration/admin_panel', compact('users'));
    }

    public function destroyCompany($id) {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);

        DB::table('joboffers')->where('companyid', '=', $id)->delete();
        DB::table('companies')->where('companyid', '=', $id)->delete();

        $users = DB::table('users')->select('userid', 'firstname', 'surname', 'username', 'userrole', 'has_company', 'created_at', 'email')->where('userrole', '<>', '2')->paginate(2);
        return view('administration/admin_panel', compact('users'));
    }

    public function destroyPicture($userid) {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);
        Storage::delete('public/avatars/'.$userid.'.jpg');
        
        return redirect()->route('admin.showuser', $userid);
    }

    public function destroyCompanyPicture($userid) {
        if(!Gate::allows('isAdmin', auth()->user())) abort(403);
        Storage::delete('public/avatars/'.$userid.'.jpg');
        $cid = DB::table('companies')->select('companyid')->where('userid', '=', $userid)->first();
        return redirect()->route('admin.showcompany', $cid->companyid);
    }
}
