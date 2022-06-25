<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobOfferController extends Controller
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
    public function store(Request $request)
    {
        $id = Auth::id();
        $offer_cid = DB::table('companies')->select('companyid')->where('userid', '=', $id)->first();

        $offer = new JobOffer;
        $offer->companyid = $offer_cid->companyid;
        $offer->position = $request->position;
        $offer->category = $request->category;
        $offer->workload = $request->workload;
        if(filled($request->salary)) $offer->salary = $request->salary;
        $offer->location = $request->location;
        $offer->description = $request->description;
        $offer->extra_info = $request->extra_info;
        $offer->posted_at = date('Y-m-d');
        $offer->save();
        
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
        $listing = JobOffer::findOrFail($id);
        $data = DB::table('users')->select('users.email', 'companies.name', 'companies.registryid')->join('companies', 'users.userid', '=', 'companies.userid')
        ->join('joboffers', 'companies.companyid', '=', 'joboffers.companyid')->where('joboffers.offerid', '=', $id)->first();
        
        return view('listing', compact('listing', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $offer = DB::table('joboffers')->select('offerid', 'position', 'category', 'workload', 'salary', 'companies.name')
        ->join('companies', 'companies.companyid', '=', 'joboffers.companyid')->where('offerid', '=', $id)->first();

        return view('edit_joboffer', compact('offer'));
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
            'position' => ['nullable', 'alpha', 'max:40'],
            'category' => ['nullable', 'alpha', 'max:30'],
            'workload' => ['nullable', 'alpha', 'max:30'],
            'location' => ['nullable', 'max:40'],
            'salary' => ['nullable', 'integer'],
            'description' => ['nullable'],
            'extra_info' => ['nullable', 'max:50']
        ];

        $request->validate($rules);

        $joboffer = JobOffer::find($request->offerid);
        if(filled($request->position)) $joboffer->position = $request->position;
        if(filled($request->category)) $joboffer->category = $request->category;
        if(filled($request->workload)) $joboffer->workload = $request->workload;
        if(filled($request->location)) $joboffer->location = $request->location;
        if(filled($request->salary)) $joboffer->salary = $request->salary;
        if(filled($request->description)) $joboffer->description = $request->description;
        if(filled($request->extra_info)) $joboffer->extra_info = $request->extra_info;
        $joboffer->save();

        $company = DB::table('companies')
        ->select('users.firstname', 'users.surname', 'companies.name', 'registryid', 'about', 'homepage', 'location', 'companyid')
        ->join('users', 'users.userid', '=', 'companies.userid')->where('users.userid', '=', Auth::id())->first();

        

        $joboffers = DB::table('joboffers')->select('offerid', 'position', 'category', 'workload', 'salary', 'posted_at', 'location')
        ->where('companyid', '=', $company->companyid)->get();

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
        $offer = JobOffer::findOrFail($id);
        $offer->delete();

        $company = DB::table('companies')
        ->select('users.firstname', 'users.surname', 'companies.name', 'registryid', 'about', 'homepage', 'location', 'companyid')
        ->join('users', 'users.userid', '=', 'companies.userid')->where('users.userid', '=', Auth::id())->first();

        

        $joboffers = DB::table('joboffers')->select('offerid', 'position', 'category', 'workload', 'salary', 'posted_at', 'location')
        ->where('companyid', '=', $company->companyid)->get();

        $user = DB::table('users')->select('firstname', 'surname', 'email')->where('userid', '=', Auth::id())->first();

        return view('company_profile', compact('company', 'joboffers', 'user'));
    }
}
