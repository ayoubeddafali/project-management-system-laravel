@extends('layouts.master3')

@section('content')

    <div class="form-control">
    {!! Form::open(['action'=>'searchController@lists','method'=>'POST']) !!}

       <p>Fill up this Form :</p>

        <div class="form-group">
            {!! Form::label('status',' Project Status ') !!}
            {!! Form::select('status',['open','completed','canceled'],'0',['id'=>'status','class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('chef',' Chef de Projet ') !!}
            {!! Form::select('chef',User::lists('name','id')->toArray(),'0',['id'=>'status', 'class'=>'form-control']) !!}

        </div>

        <div class="form-group">
            {!! Form::label('pays',' Pays :') !!}
            {!! Form::text('pays',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('entreprise',' Entreprise') !!}
            {!! Form::text('entreprise',null,['class'=>'form-control']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('fin','Date de fin: ') !!}
            {!! Form::input('date','fin',\Carbon\Carbon::tomorrow()->toDateString(),['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit(' Search ',['class'=>'form-control btn btn-success']) !!}
        </div>

    {!! Form::close() !!}
    </div>

@stop