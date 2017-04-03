<?php

namespace App\Http\Controllers;

use App\Collaboration;
use Illuminate\Http\Request;

use App\Http\Requests;

class collaborationsController extends Controller
{
    public function add(Request $request , $project_id){
        $collaboration = Collaboration::create($request->input());
        $collaboration->projects()->attach($project_id);
        return redirect('/projects/'.$project_id);
    }
    public function delete($collaboration_id , $project_id){
        $collaboration = Collaboration::find($collaboration_id);
        $collaboration->delete();
        $collaboration->projects()->detach($project_id);
        return redirect('/projects/'.$project_id);
        
    }
}
