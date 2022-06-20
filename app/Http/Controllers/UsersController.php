<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'name' => 'required|alpha|max:30',
            'surname' => 'required|alpha|max:30',
            'username' => 'required|alpha_dash|max:20',
            'email' => 'required|email|max:100',
            'password' => 'required|not_regex:/^[a-z0-9]+$/|min:8'
        ];
        
        $messages = [
            'password.not_regex' => 'Password must contain at least one capital letter or symbol.'
        ];

        $request->validate($rules, $messages);

        //to be added profile view redirect
        return "hi";
    }

    // Show view for logging in.
    public function show() {
         return view('login');
    }

    // Login validation and authorization
    public function login() {
        return "logged in";
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
