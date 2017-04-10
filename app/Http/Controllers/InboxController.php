<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Inbox;
use Illuminate\Support\Facades\Auth;


class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $inbox = Inbox::orderBy('created_at','desc')->get();

        return view('backend.mailbox.index',compact('inbox'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.contactus');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'body' => 'required',
            'subject' => 'required',
        ]);
        if ($validator->fails()) {
            return \Redirect::to('/contact')
                ->withErrors($validator);
        } else {
            $msg = New Inbox();
            if (Auth::check()){
                $msg->name = Auth::user()->FullName();
                $msg->email = Auth::user()->email;
                $msg->phone = Auth::user()->phone;
                $msg->subject = $request->subject;
                $msg->body = $request->body;
                $msg->read = 0;

            }else{
                $msg->name = $request->name;
                $msg->email = $request->email;
                $msg->phone = $request->phone;
                $msg->subject = $request->subject;
                $msg->read = 0;
                $msg->body = $request->body;
            }
            $msg->save();
            // redirect
            \Session::flash('message', 'تم إرسال رسالتك بنجاح!');
            return \Redirect::to('/');
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

        $user = Inbox::findOrFail($id);
        $user->read = 1;
        $user->save();
        return $user;
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
