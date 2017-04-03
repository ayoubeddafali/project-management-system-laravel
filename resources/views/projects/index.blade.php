@extends('layouts.master3')

@section('style')
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">--}}

@stop

@section('content')
    @if(Auth::user()->role == 'admin')
    <h2 id="projects"> Projects : <a id="new" class="btn btn-primary" href="/projects/create">New Project</a>
        <a id="import" class="btn btn-danger">Import Project</a></h2>
        @else
        <h2 id="projects">My Projects</h2>
    @endif

    <div style="border-radius: 5px;" class="no-padding">
        <table class="table table-bordered table-striped " style="padding-bottom: 60px;  font-family:'Lucida Grande', sans-serif ; background-color:#DCDCDC ; color: #0c0c0c;">
            <tr>
                <th>Libelle</th>
                <th>Chef</th>
                <th>Status</th>
                <th>Date de fin</th>
                <th>Milestones</th>
                <th>Tasks</th>
                <th>Risks</th>
                <th>Files</th>
                <th>Actions</th>
            </tr>





    @foreach($projects as $project)
            <tr>
                <td><a style="text-transform: uppercase" href="/projects/{{$project->id}}">{{$project->libelle}}</a></td>
                <td> {{User::find($project['chef'])['name']}}</td>
                <td>{{Status::find($project->status)['name']}}</td>
                <td> {{ $project->fin  }} </td>
                <td> {{ count($project->milestones->toArray())  }} </td>
                <td> {{ count($project->tasks->toArray()) }} </td>
                <td> {{ count($project->risks->toArray())  }} </td>
                <td> {{count($project->files->toArray())}} </td>
                <td>
                    <div style="padding-left: 15px" class="box-tools">
                        <!-- button with a dropdown -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-info  btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bars"></i></button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="/projects/{{$project->id}}">View Details</a></li>
                                @if(Auth::user()->role =='admin')
                                <li><a href="/projects/{{$project->id}}/edit">Edit Project</a></li>
                                <li><a href="/projects/{{$project->id}}/delete">Delete Project</a></li>
                                @elseif(User::find(Auth::user()->id)->roles()->where(['role_id'=>2,'project_id'=>$project->id])->exists())
                                    <li><a href="/projects/{{$project->id}}/edit">Edit Project</a></li>

                                @endif
                                <li  class="divider"></li>
                                <li><a href="/export/all/{{$project->id}}">Export details to CSV</a></li>
                                <li><a href="">Export to PDF</a></li>
                            </ul>
                        </div>

                    </div>
                </td>

            </tr>
    @endforeach
        </table>
    </div>


@endsection

@section('script')
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>--}}

    <script>
        $('#import').click(function () {


                bootbox.dialog({
                    title: 'Import a Project ',
                    message:
                    'Please Click here to download the project template ' + '<br> <b>Download :</b>' +
                            '<a href="/uploads/template_projekt.csv" >  template.csv</a><br>'+
                 '{!! Form::open(['action'=>'exportController@import','method'=>'POST', 'files'=>true]) !!}' +
                        ' <div class="form-group">'+
                ' {!! Form::file('project_template') !!}'+
                 '</div>'+
                    '<div class="form-group">'+
                        '{!! Form::submit('Import',['class'=>'form-control btn btn-success']) !!}'+
                        '</div>'+
                         '{!! Form::close() !!}'
                });


        });

        $('.project_card').mouseenter(function(){
            $(this).css('background-color','#E1E1E1');
        } ).mouseleave(function()
        {
            $(this).css('background-color','#C3C3C3');
        });
    </script>
@stop