<?php

namespace App\Http\Controllers;

use App\Historic;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class tasksController extends Controller
{
    public function index(){
        
        $assigned_tasks = Task::where('assigned',Auth::user()->id)->get();
        return view('tasks.index',compact('assigned_tasks'));
        
    }
    public function transmitted(){
        $transmitted_tasks = Task::where('transmitter',Auth::user()->id)->get();
        return view('tasks.transmitted',compact('transmitted_tasks'));
        
    }
    public function store($project_id , Request $request){
        $request['project_id']=$project_id ;
        $request['transmitter']=Auth::user()->id ; 
        Task::create($request->all());

        Historic::create(['user_id'=>Auth::user()->id,'project_id'=>$project_id,'comment'=>'A creer une tache dans le projet :']);

        return redirect("/projects/".$project_id);

    }
    public function delete($task_id , $project_id){
        Task::find($task_id)->delete();
        Historic::create(['user_id'=>Auth::user()->id,'project_id'=>$project_id,'comment'=>'A supprimer une tache dans le projet :']);

        return redirect("/projects/$project_id");
    } 
    public function remove($task_id ){
        Task::find($task_id)->delete();
        return redirect("/tasks/index");
    }
}
