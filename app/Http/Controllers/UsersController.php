<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Experience;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class UsersController extends Controller
{
    // Retrieve data and view for user's profile
    public function index() {
        $id = Auth::id();
        $representsCompany = DB::table('users')->select('has_company')->where('userid', '=', $id)->first();

        if($representsCompany->has_company == 1) {
            $company = DB::table('companies')
            ->select('users.firstname', 'users.surname', 'companies.name', 'registryid', 'about', 'homepage', 'location', 'companyid')
            ->join('users', 'users.userid', '=', 'companies.userid')->where('users.userid', '=', $id)->first();

            // if the account has not created a company entry in the database, redirect to create form
            if(empty($company)) {
                return redirect()->route('add.company');
            }

            $joboffers = DB::table('joboffers')->select('offerid', 'position', 'category', 'workload', 'salary', 'posted_at', 'location')
            ->where('companyid', '=', $company->companyid)->get();

            $user = DB::table('users')->select('firstname', 'surname', 'email')->where('userid', '=', Auth::id())->first();

            return view('company_profile', compact('company', 'joboffers', 'user'));
        }

        else {
            $data = DB::table('users')->select('firstname', 'surname', 'email')->where('userid', '=', $id)->first();

            $education = DB::table('education')->join('users', 'education.userid', '=', 'users.userid')
            ->select('eduid', 'institution', 'startyear', 'endyear', 'program')->where('education.userid', '=', $id)->get();

            $experience = DB::table('experience')->join('users', 'users.userid', '=', 'experience.userid')
            ->select('expid', 'workplace', 'startyear', 'endyear', 'position')->where('experience.userid', '=', $id)->get();
            return view('user_profile', compact('data', 'education', 'experience'));
        }
        
    }

    // Show view for registering
    public function create() {
        if(Auth::check()) {
            redirect('/');
        }

        return view('register');
    }

   // Validate and create a new user entry in the database
    public function store(Request $request) {
        $rules = [
            'firstname' => ['required', 'alpha','max:30'],
            'surname' => ['required', 'alpha', 'max:30'],
            'username' => ['required', 'alpha_dash', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', 'max:100', Rule::unique('users', 'email')],
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()]
        ];
        $request->validate($rules);
        
        $user = new User;
        $user->firstname = $request->firstname;
        $user->surname = $request->surname;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->userrole = 1;
        if($request->is_representer) $user->has_company = true;
        else $user->has_company = false;
        $user->save();

        auth()->login($user);
        return redirect('/')->with('message', 'User created and logged in!');
    }

    // Show view for logging in.
    public function show() {
        if(Auth::check()) {
            redirect('/');
        }

         return view('login');
    }

    // Login validation and authentication
    public function authenticate(Request $request) {
        $rules = [
            'username' => ['required', 'alpha_dash', 'max:20'],
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()]
        ];
        $credentials = $request->validate($rules);
        if($request->remember_me) {
            if(Auth::attempt($credentials, true)) {
                $request->session()->regenerate();
                return redirect()->intended('/')->with('message', 'Successfully logged in !');
            }
        }
        else {
            if(Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/')->with('message', 'Successfully logged in !');
            }
        }

        return back()->withErrors(['warning' => 'Invalid username or password.']);
    }

    // Logout currently authenticated user
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'Successfully logged out !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
