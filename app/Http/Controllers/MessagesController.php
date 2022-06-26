<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if(Auth::id() != $id && !Gate::allows('isAdmin', auth()->user())) {
            abort(403);
        }

        $rid = DB::table('messages')->select('receiverid')->distinct()->where('senderid', '=', $id)->get();
        $sid = DB::table('messages')->select('senderid')->distinct()->where('receiverid', '=', $id)->get();
        $recipients = array();
        foreach($rid as $item) {
            array_push($recipients, $item->receiverid);
        }
        foreach($sid as $item) {
            array_push($recipients, $item->senderid);
        }
        $msgs = DB::table('users')->select('firstname', 'surname', 'email', 'userid')->whereIn('userid', $recipients)->paginate(5);
        $uid = Auth::id();
        return view('list_messages', compact('msgs', 'uid'));
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
        if($request->has('check')) {
            if(Auth::id() != $request->check && !Gate::allows('isAdmin', auth()->user())) {
                abort(403);
            }    
        }
        else if($request->has('senderid')) {
            if(Auth::id() != $request->senderid && !Gate::allows('isAdmin', auth()->user())) {
                abort(403);
            }    
        }
        
        if($request->has('fromprofile')) {
            $msg = new Message;
            $msg->senderid = $request->senderid;
            $msg->receiverid = $request->receiverid;
            $msg->message = $request->message;
            $msg->save();

            $sent = DB::table('messages')->select('senderid', 'receiverid', 'message', 'created_at')
            ->where('senderid', '=', $request->senderid)->where('receiverid', '=', $request->receiverid);

            $messages = DB::table('messages')->select('senderid', 'receiverid', 'message', 'created_at')
            ->where('senderid', '=', $request->receiverid)->where('receiverid', '=', $request->senderid)->union($sent)->oldest()->get();
            
            
            $name = DB::table('users')->select('firstname', 'surname')->where('userid', '=', $request->receiverid)->first();
            $uid = $request->senderid;
            $rid = $request->receiverid;
            return view('view_conversation', compact('messages', 'name', 'uid', 'rid'));
        }

        $msg = new Message;
        $msg->senderid = Auth::id();
        $msg->receiverid = $request->userid;
        $msg->message = $request->message;
        $msg->save();

        return redirect()->back()->with('message', 'Message was sent !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        if(Auth::id() != $request->senderid && !Gate::allows('isAdmin', auth()->user())) {
            abort(403);
        }

        $sent = DB::table('messages')->select('senderid', 'receiverid', 'message', 'created_at')
        ->where('senderid', '=', $request->senderid)->where('receiverid', '=', $request->receiverid);

        $messages = DB::table('messages')->select('senderid', 'receiverid', 'message', 'created_at')
        ->where('senderid', '=', $request->receiverid)->where('receiverid', '=', $request->senderid)->union($sent)->oldest()->get();
        
        
        $name = DB::table('users')->select('firstname', 'surname')->where('userid', '=', $request->receiverid)->first();
        $uid = $request->senderid;
        $rid = $request->receiverid;
        return view('view_conversation', compact('messages', 'name', 'uid', 'rid'));
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
