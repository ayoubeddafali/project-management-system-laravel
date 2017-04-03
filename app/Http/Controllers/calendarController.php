<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JavaScript;
use App\Http\Requests;

class calendarController extends Controller
{
    public function index(){
        if (Auth::user()->role == 'admin')
        $projects = Project::all()->toArray();
        else {
            $projects =  User::find(Auth::user()->id)->projects()->get();
        }
        JavaScript::put([
            'projects' => $projects
            
        ]);
        return view('calendar.index');
    }
}
