<?php

namespace App\Http\Controllers;

use App\File;
use App\Historic;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ApplyController extends Controller
{
    public function upload($project_id , Request $request) {
        // getting all of the post data
        $file = array('image' => Input::file('image'));

        // setting up rules
        $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('/projects/'.$project_id)->withInput()->withErrors($validator);
        }
        else {
            // checking file is valid.
            if (Input::file('image')->isValid()) {
                $destinationPath = 'uploads'; // upload path
//                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = Input::file('image')->getClientOriginalName();
                Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                File::create(['name'=>$fileName,'project_id'=>$project_id , 'uploader_id'=>Auth::user()->id]);
                // sending back with message
                Session::flash('success', 'Upload successfully');
                Historic::create(['user_id'=>Auth::user()->id,'project_id'=>$project_id,'comment'=>'A uploader un fichier dans le projet :']);

                return Redirect::to('/projects/'.$project_id);
            }
            else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
                return Redirect::to('/projects/'.$project_id);
            }
        }
    }
    
    public function delete($file_id , $project_id){
        File::find($file_id)->delete();
        Historic::create(['user_id'=>Auth::user()->id,'project_id'=>$project_id,'comment'=>'A supprimer un fichier dans le projet :']);

        return Redirect::to('/projects/'.$project_id);

    }

}
