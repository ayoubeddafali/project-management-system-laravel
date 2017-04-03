<?php

namespace App\Http\Controllers;

use App\Historic;
use App\Risk;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class risksController extends Controller
{
    public function store(Request $request , $id){
        $request['project_id'] = $id ; 
        Risk::create($request->all());
        Historic::create(['user_id'=>Auth::user()->id,'project_id'=>$id,'comment'=>'A ajouter un risque dans le projet :']);

        return redirect('/projects/'.$id);
    }

    public function delete($risk_id , $project_id){
        Risk::find($risk_id)->delete();
        
        Historic::create(['user_id'=>Auth::user()->id,'project_id'=>$project_id,'comment'=>'A supprimer un risque dans le projet :']);

        return redirect("/projects/$project_id");
    }
}
