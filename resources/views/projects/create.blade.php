@extends('layouts.master3')

@section('style')
    <style>
        #form {
                color: #DCDCDC;
            } 

    </style>
@endsection



    
@section('content')

    <h1 class="page-header" style="color: lightgrey;" >Create Project </h1>
    {!! Form::open(['action'=>'projectsController@store','id'=>'form','method'=>'POST', 'files'=>true]) !!}
        @include('partials.form',['action_project'=>'Add','team_members'=>null])
    {!! Form::close() !!}
@endsection()

