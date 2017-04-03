<?php

namespace App\Http\Controllers;
use App\Cout;
use App\Historic;
use App\Http\Requests\CreateProjectRequest;
use App\Milestone;
use App\Role;
use App\Task;
use Illuminate\Support\ViewErrorBag;
use JavaScript;
use App\File;
use App\Project;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;


class projectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teamLeader',['only'=>['edit','update']]);
    }

    public function index(){
        $user_id = Auth::user()->id;
        $membersExceptMe = User::where('id','!=',$user_id)->get()->lists('name','id');
        if(Auth::user()->role == 'admin'){

            $projects = Project::all();
        }else {
            $projects = User::find($user_id)->projects;

        }
        
        
        return view('projects.index',compact('projects','membersExceptMe','user_id'));
        

    }
    public function show($id){
        $project =  Project::where('id',$id)->first();
        $totalTasks = count(Task::all()->toArray());
        $milestones_lists = Milestone::all()->pluck('numero','id');
        JavaScript::put([
            'project_id' =>$id,
            'totalTasks'=> $totalTasks+1
        ]);
        return view('projects.show',compact('project','milestones_lists'));

    }

    public function create(){
        $members = User::lists('name','id');

        return view('projects.create',compact('members'));
    } 
    
    public function store(CreateProjectRequest $request){
        $fileName = Input::file('logo')->getClientOriginalName();
        $destinationPath = 'img';
        $request['logo'] = $fileName;



        $data = $request->input();

        Input::file('logo')->move($destinationPath, $fileName);
        $project = Project::create($data);

        $project->users()->attach($request->input('members'));
        if (! $project->users()->where(['user_id'=>User::find($request['chef'])->id,'project_id'=>$project->id])->exists()){

            $project->users()->attach(['id'=>User::find($request['chef'])->id]);
        }
        User::find(intval($request['chef']))->roles()->attach(Role::find(2),['project_id'=>$project->id]);
        Role::find(3)->users()->attach($request->input('members'),['project_id'=>$project->id]);
        File::create(['name'=>$fileName,'project_id'=>$project->id, 'uploader_id'=>Auth::user()->id]);
        
        Historic::create(['user_id'=>Auth::user()->id,'project_id'=>$project->id,'comment'=>'A creer un nouveau projet']);
        return redirect('/admin/dashboard');

    }
    public function edit($id){
        $members = User::lists('name','id');
        $project = Project::where('id',$id)->first();
        return view('projects.edit',compact('project','members'));
    
    }
    public function addBudget($project_id , Request $request){
        $cout = Cout::create($request->input());
         $project = Project::find($project_id);
        if ($project_id){
            $project->cout_id = $cout->id ;
            $project->save();
        }
        Historic::create(['user_id'=>Auth::user()->id,'project_id'=>$project->id,'comment'=>'A ajouter un budget pour le projet :']);


        return redirect('/projects/'.$project_id);

    }
    public function editBudget($project_id, $cout_id , Request $request){
        $cout = Cout::find($cout_id)->update($request->input());
        $project = Project::find($project_id);
        if ($project_id){
            $project->cout_id = $cout_id ;
            $project->save();
        }
        Historic::create(['user_id'=>Auth::user()->id,'project_id'=>$project->id,'comment'=>'A Modifier le budget pour le projet :']);


        return redirect('/projects/'.$project_id);
    }
    public function update(CreateProjectRequest $request , $id){
        $fileName = Input::file('logo')->getClientOriginalName();
        $request['logo'] = $fileName;
        $destinationPath = 'img';


        $project =  Project::where('id',$id)->first();
        $project->update($request->input());
        DB::table('project_user')->where('project_id', $project->id)->delete();
        $project->users()->attach($request->input('members'));
        if (! $project->users()->where(['user_id'=>User::find($request['chef'])->id,'project_id'=>$project->id])->exists()){

            $project->users()->attach(['id'=>User::find($request['chef'])->id]);
        }

        DB::table('role_user')->where('project_id', $project->id)->delete();
        User::find(intval($request['chef']))->roles()->attach(Role::find(2),['project_id'=>$project->id]);
        Role::find(3)->users()->attach($request->input('members'),['project_id'=>$project->id]);



        Input::file('logo')->move($destinationPath, $fileName);
        File::create(['name'=>$fileName,'project_id'=>$id, 'uploader_id'=>Auth::user()->id]);

        Historic::create(['user_id'=>Auth::user()->id,'project_id'=>$project->id,'comment'=>'A editer le projet :']);
        return redirect('projects'); 

    }
    public function remove($project_id){
        Project::find($project_id)->delete();
        Historic::create(['user_id'=>Auth::user()->id,'project_id'=>$project_id,'comment'=>'A supprimer le projet :']);
        return redirect('/projects');
    }


    //
    public function searchByUserId($user_id , $text){

        if (User::find($user_id)->role == 'admin')
        {
            return Project::where('libelle','LIKE',"$text%")->get();
        }
        else
        {
        return  User::find($user_id)->projects()->where()->get();

        }
    }
 
}
