<?php

namespace App\Http\Controllers;

use App\Cout;
use App\Message;
use App\Milestone;
use App\Project;
use App\Risk;
use App\Task;
use App\Todo;
use App\User;
use App\Status;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use phpDocumentor\Reflection\DocBlock\Tag;

class adminController extends Controller
{
    /*
        You should implemets a admin middleware so that normal users can't have access to
                admin panel
    */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        $projects =  Project::all()->toArray();
        return view('admin.index',compact('projects','user'));
    }
    public function users(){
        $user = Auth::user();
        $users =  User::all()->toArray(); 
        return view('admin.users',compact('users','user')); 
    }

    public  function dashboard(){
        $user_id = intval(Auth::user()->id);
        $user = User::find($user_id);
        $todos = $user->todos()->get();

      

        if(Auth::user()->role == 'admin'){

            $projects = Project::all()->toArray();
            $tasks = Task::all();
        }else {
            $projects = 
                User::find($user_id)->projects->toArray();
            $tasks = Task::where('assigned',$user_id)->get();
            
        }
        
        $couts = Cout::all()->toArray();

        $risks = Risk::all()->toArray();
        $budgets = Cout::all()->toArray();
        if(Auth::user()->role == 'admin'){

            $membersExceptMe = User::where('id','!=',$user_id)->get()->lists('email','email');
        }else {
            $membersExceptMe = User::where('role','=','admin')->get()->lists('email','email');

        }
        return view('admin.dashboard',compact('projects','user','todos','membersExceptMe','risks','tasks','couts','budgets'));
    }
    public function addTodo(Request $request , $id){

            Todo::create([
                'description'=>$request['description'],
                'due'=>$request['due'],
                'user_id'=>intval($id)
            ]);
        return redirect('/admin/dashboard');

    }

    public function deleteTodo($todo_id){
//        dd($todo_id);
        Todo::find($todo_id)->delete();
        return redirect('/admin/dashboard');
    }
    public function sent_message(Request $request){
        $request['to'] = User::where('email',$request->input('toWhom'))->first()->id;
        $request['from'] = Auth::user()->id ;
         Message::create($request->all());
        return redirect('/admin/dashboard');

    }





}

