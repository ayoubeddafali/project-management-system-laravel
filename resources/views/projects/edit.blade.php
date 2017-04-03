@extends('layouts.master3')

@section('content')
    <h1 class="page-header" >Edit Project </h1>
    {!! Form::model($project,['url'=>'projects/'.$project->id,'method'=>'PATCH', 'files'=>true]) !!}
    @include('partials.form',['action_project'=>'Edit','team_members'=>$project->users()->get()->lists('id')->toArray()])
    {!! Form::close() !!}
@endsection()