@extends('layouts.master3')

@section('content')
    <div class="container" style="margin-top: 10%">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Profile</div>
                    <div class="panel-body">
                        {!! Form::open(['url'=>'/profile/store' , 'files'=>true]) !!}
                        <div class="form-group">
                            {!! Form::label('name','Name ') !!}
                            {!! Form::text('name',null,['class'=>'form-control','required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email','E-mail ') !!}
                            {!! Form::email('email',null,['class'=>'form-control','required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password','Password') !!}
                            {!! Form::password('password',['class'=>'form-control']) !!}
                        </div>
                        @if(Auth::user()->role == 'admin')
                            <div class="form-group">
                                {!! Form::label('role','Role ') !!}
                                {!! Form::select('role',['admin'=>'admin','user'=>'user'],'user',['class'=>'form-control']) !!}
                            </div>
                        @endif
                        <div class="form-group">
                            {!! Form::label('logo','Logo ') !!}
                            {!! Form::file('logo') !!}
                        </div>


                        <div class="form-group">
                            {!! Form::submit('Add',['class'=>'form-control btn btn-success']) !!}
                        </div>


                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>

@endsection()
