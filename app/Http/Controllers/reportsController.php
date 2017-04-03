<?php

namespace App\Http\Controllers;

use App\Milestone;
use App\Project;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JavaScript;
use App\Http\Requests;

class reportsController extends Controller
{
    public function index(){
        JavaScript::put([
            'projects' => count(Project::all()->toArray()) ,
            'tasks'=> count(Task::all()->toArray()),
            'milestones'=>count(Milestone::all()->toArray())
        ]);
        $total = Project::where( 'created_at', '>=', Carbon::now()->firstOfYear())->get()->toArray();
        $users = DB::table('project_user')->select(DB::raw('count(user_id) as count'),'users.name')->join('users','users.id','=','project_user.user_id')->groupBy('user_id')->get();    
        return view('reports.index' , compact('total','users'));
    }
}
