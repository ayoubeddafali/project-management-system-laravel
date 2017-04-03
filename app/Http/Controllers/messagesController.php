<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class messagesController extends Controller
{
    public function index(){
        $inboxs= User::find(Auth::user()->id)->messages()->get();
        return view('messages.index',compact('inboxs'));
    }
    public function  show($message_id){

        return Message::find($message_id)->toArray();

    }
    public function respond(Request $request ,$from){
        $request['to'] = intval($from);
        $request['from'] = Auth::user()->id ;
        Message::create($request->input());
        return redirect('/admin/dashboard');
        
    }
    public function sent(){
        $inboxs= User::find(Auth::user()->id)->sent_messages()->get();
        return view('messages.sent',compact('inboxs'));
    }
    public function delete($message_id){
        Message::find($message_id)->delete();
        return redirect('/messages/all');
        
    }
}
