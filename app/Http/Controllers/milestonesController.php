<?php

namespace App\Http\Controllers;

use App\Milestone;
use Illuminate\Http\Request;

use App\Http\Requests;

class milestonesController extends Controller
{
    public function add($project_id , Request $request){
        $request['project_id'] = $project_id ;
        Milestone::create($request->input());

        return redirect('/projects/'.$project_id);
    }
    public function delete($project_id){
        Milestone::find($project_id)->delete();
        return redirect('/projects/');
    }
}
