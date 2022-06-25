<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('add_company', ['firstname' => $user->firstname, 'surname' => $user->surname]);
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
    public function store(Request $request)
    {   
        $rules = [
            'name' => ['required', 'max:50'],
            'registryid' => ['required', 'integer', 'digits:11'],
            'homepage' => ['required', 'max:30'],
            'location' => ['required', 'max:30'],
            'about' => ['required'],
        ];
        
        $messages = ['registryid.integer' => 'The registry ID must only contain digits.'];

        $request->validate($rules);

        $new_company = new Company;
        $new_company->userid = Auth::id();
        $new_company->name = $request->name;
        $new_company->about = $request->about;
        $new_company->registryid = $request->registryid;
        $new_company->homepage = $request->homepage;
        $new_company->location = $request->location;
        $new_company->save();


        $company = DB::table('companies')
        ->select('users.firstname', 'users.surname', 'companies.name', 'registryid', 'about', 'homepage', 'location', 'companyid')
        ->join('users', 'users.userid', '=', 'companies.userid')->where('users.userid', '=', Auth::id())->first();

        $joboffers = DB::table('joboffers')->select('offerid', 'position', 'category', 'workload', 'salary', 'posted_at', 'location')
        ->where('companyid', '=', $company->companyid)->get();

        $user = DB::table('users')->select('firstname', 'surname', 'email')->where('userid', '=', Auth::id())->first();

        return view('company_profile', compact('company', 'joboffers', 'user'));
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data = DB::table('companies')->select('name', 'registryid', 'homepage', 'location', 'about')->where('userid', '=', Auth::id())->first();
        return view('edit_company', compact('data'));
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
            'name' => ['nullable', 'max:50'],
            'registryid' => ['nullable', 'integer', 'digits:11'],
            'homepage' => ['nullable', 'max:30'],
            'location' => ['nullable', 'max:30'],
            'email' => ['nullable', 'email', 'max:100'],
            'firstname' => ['nullable', 'alpha', 'max:30'],
            'surname' => ['nullable', 'alpha', 'max:30']
        ];

        $messages = [
            'registryid.integer' => 'The registry ID must only contain digits.',
            'location:regex' => 'The location must only contain letters, numbers or dashes.'
        ];

        $request->validate($rules);

        $company = DB::table('companies')
        ->select('users.firstname', 'users.surname', 'companies.name', 'registryid', 'about', 'homepage', 'location', 'companyid')
        ->join('users', 'users.userid', '=', 'companies.userid')->where('users.userid', '=', Auth::id())->first();

        $joboffers = DB::table('joboffers')->select('offerid', 'position', 'category', 'workload', 'salary', 'posted_at', 'location')
        ->where('companyid', '=', $company->companyid)->get();

        

        $cid = $company->companyid;

        $update_company = Company::find($cid);
        if(filled($request->name)) $update_company->name = $request->name;
        if(filled($request->registryid)) $update_company->registryid = $request->registryid;
        if(filled($request->homepage)) $update_company->homepage = $request->homepage;
        if(filled($request->location)) $update_company->location = $request->location;
        if(filled($request->about)) $update_company->about = $request->about;
        $update_company->save();

        $update_user = User::find(Auth::id());
        if(filled($request->firstname)) $update_user->firstname = $request->firstname;
        if(filled($request->surname)) $update_user->surname = $request->surname;
        if(filled($request->email)) $update_user->email = $request->email;
        $update_user->save();

        $user = DB::table('users')->select('firstname', 'surname', 'email')->where('userid', '=', Auth::id())->first();

        return view('company_profile', compact('company', 'joboffers', 'user'));
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
