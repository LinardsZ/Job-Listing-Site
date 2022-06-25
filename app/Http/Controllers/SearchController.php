<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOffer;
use Illuminate\Support\Facades\DB;
class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = DB::table('joboffers')->select('offerid', 'position', 'category', 'description', 'salary', 'name')
        ->join('companies', 'joboffers.companyid', '=', 'companies.companyid')->paginate(6);
        foreach($offers as $offer) {
            $offer->description = substr($offer->description, 0, 100);
            if (strlen($offer->description) == 100) {
                $offer->description = $offer->description.'...';
            }
        }
        return view('landing', compact('offers'));
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
        //
    }

    //retrieve job offers filtered by search request data
    public function show(Request $request) {
        //if no search fields were filled, return all jobs paginated
        if(empty($request->category) && empty($request->location) && empty($request->keywords)) {
            $offers = DB::table('joboffers')->select('offerid', 'position', 'category', 'description', 'salary', 'name', 'workload', 'posted_at')
            ->join('companies', 'joboffers.companyid', '=', 'companies.companyid')->paginate(2);
            foreach($offers as $offer) {
                $offer->description = substr($offer->description, 0, 300);
                if (strlen($offer->description) == 300) {
                    $offer->description = $offer->description.'...';
                }
            }
            return view('search_result', compact('offers')); 
        }

        else {
            $offers = DB::table('joboffers')->select('offerid', 'position', 'category', 'description', 'salary', 'name', 'workload', 'posted_at')
            ->join('companies', 'joboffers.companyid', '=', 'companies.companyid');
            
            if(!empty($request->category)) {
            $offers->where('category', 'like', '%'.$request->category.'%');
            }

            if(!empty($request->location)) {
                if(empty($request->category)) $offers->where('location', 'like', '%'.$request->location.'%');
                else $offers->orWhere('location', 'like', '%'.$request->location.'%');
            }

            if(!empty($request->keywords)) {
                if (empty($request->category) && empty($request->location)) $offers->where('description', 'like', '%'.$request->keywords.'%');
                else $offers->orWhere('description', 'like', '%'.$request->keywords.'%');

                $offers->orWhere('position', 'like', '%'.$request->keywords.'%')
                ->orWhere('salary', 'like', '%'.$request->keywords.'%')
                ->orWhere('name', 'like', '%'.$request->keywords.'%');
            }

            $offers = $offers->paginate(2);

            foreach($offers as $offer) {
                $offer->description = substr($offer->description, 0, 300);
                if (strlen($offer->description) == 300) {
                    $offer->description = $offer->description.'...';
                }
            }
            $input = $request->keywords;
            return view('search_result', compact('offers', 'input'));
        }
        
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
}
