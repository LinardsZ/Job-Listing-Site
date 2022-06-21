<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    // Show view for registering
    public function create() {
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
         return view('login');
    }

    // Login validation and authentication
    public function authenticate(Request $request) {
        $rules = [
            'username' => ['required', 'alpha_dash', 'max:20'],
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()]
        ];
        $credentials = $request->validate($rules);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('message', 'Successfully logged in !');
        }

        return back()->withErrors(['warning' => 'Invalid username or password.']);
    }

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
