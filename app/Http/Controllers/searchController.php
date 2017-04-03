<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class searchController extends Controller
{
    public function index(){
        return view('search.index');
    }
    public function lists(Request $request){
//        dd($request->all());
//        die();
        $projects = DB::table('projects')->where('status',$request['status'])->orWhere('entreprise',$request['entreprise'])->orWhere('pays',$request['pays'])->orWhere('chef',User::find($request['chef'])->id)->orWhere('fin','<',$request['fin'])->get();
        array_walk($projects,function (&$item , $key)
        {
            $item = (array) $item ;
        } );
        return view('search.list',compact('projects'));
        



    }
}
