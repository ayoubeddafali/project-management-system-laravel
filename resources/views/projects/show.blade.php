@extends('layouts.master3')
@section('content')
    <div  class="project_privacy">
{{--PROJECT STUFF --}}

        {{--TOP BUTTONS TO SCROLL DOWN--}}
        <div id="list">
            <ul class="pager">
                <li><a class="ancres" id="milestone" title="View project milestones"><i class="fa fa-arrow-down"></i> Milestones</a></li>
                <li><a class="ancres" id="task" title="View project tasks"><i class="fa fa-arrow-down"></i> Tasks</a></li>
                <li><a class="ancres" id="file" title="View project files"><i class="fa fa-arrow-down"></i> Attachements</a></li>
                <li><a class="ancres" id="risk" title="View project risks"><i class="fa fa-arrow-down"></i> Risks</a></li>
                <li><a class="ancres" id="user" title="View project users"><i class="fa fa-arrow-down"></i> Users</a></li>
                <li><a class="ancres" id="collaboration" title="View project collaborations"><i class="fa fa-arrow-down"></i> Collaborations</a></li>
                <li><a class="ancres" id="budget" title="View project budget"><i class="fa fa-arrow-down"></i> Budget</a></li>
            </ul>
        </div>

        {{--DESCRIPTION--}}
<div class="box box-primary  ">
    <div class="box-header">
        <i class="ion ion-clipboard"></i>

        <h3 class="box-title">Description</h3>
        <div class="pull-right box-tools">
            <!-- button with a dropdown -->
            <div class="btn-group">

                @if(Auth::user()->role == 'admin' )
                    <button type="button" title="More" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bars"></i></button>
                <ul class="dropdown-menu pull-right" role="menu">

                    <li><a  href="/projects/{{$project['id']}}/edit">Edit Project</a></li>
                        <li><a href="/projects/{{$project['id']}}/delete">Delete Project</a></li>

                </ul>
                @endif

                @if(User::find(Auth::user()->id)->roles()->where(['role_id'=>2,'project_id'=>$project['id']])->exists() && Auth::user()->role != 'admin')
                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a  href="/projects/{{$project['id']}}/edit">Edit Project</a></li>
                    </ul>
                @endif

            </div>
            <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>


    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="container">
            <div class="row">



                    <div class="panel panel-primary" style="width: 80%; margin-left: 5%;">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ ucfirst($project->libelle)  }}</h3>
                        </div>
                        <div class="panel-body">
                            <div >
                                <div class="col-md-3 col-lg-3 " > <img alt="Project Logo" src="/img/{{$project->logo}}" class="img-circle img-responsive"> </div>


                                <div class=" col-md-9  ">
                                    <table class="table table-user-information">
                                        <tbody>
                                        <tr>
                                            <td><b>Description</b> <span class="pull-right">:</span></td>
                                            <td>{{$project->libelle_long}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Status</b> <span class="pull-right">:</span></td>
                                            <td>{{Status::find($project->status)['name']}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Chef de projet</b> <span class="pull-right">:</span></td>
                                            <td>{{User::find($project->chef)['name']}}</td>
                                        </tr>

                                        <tr>
                                            <td><b>Date de debut</b> <span class="pull-right">:</span></td>
                                            <td>{{ $project->debut }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Date de fin</b> <span class="pull-right">:</span></td>
                                            <td>{{ $project->fin }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Continent</b> <span class="pull-right">:</span></td>
                                            <td>{{$project->continent}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Pays</b> <span class="pull-right">:</span></td>
                                            <td>{{$project->pays}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Site</b> <span class="pull-right">:</span></td>
                                            <td>{{$project->site}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Entreprise</b> <span class="pull-right">:</span></td>
                                            <td>{{$project->entreprise}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Direction</b> <span class="pull-right">:</span></td>
                                            <td>{{$project->direction}}</td>
                                        </tr>





                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>


                    </div>

            </div>
        </div>

    </div>
    <!-- /.box-body -->

</div>

        {{--MILESTONES--}}
<div id="project_milestones" class="box box-info ">
            <div class="box-header">
                <i class="ion ion-document"></i>

                <h3 class="box-title ">Milestones</h3>
                <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    @if(Auth::user()->role == 'admin' )
                    <div class="btn-group">
                        <button type="button" title="More" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i></button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a  class="add_milestone">Add Milestone</a></li>
                            {{--<li><a href="#">Delete Milestone</a></li>--}}

                        </ul>
                    </div>
                    @elseif(User::find(Auth::user()->id)->roles()->where(['role_id'=>2,'project_id'=>$project->id])->exists())
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bars"></i></button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a  class="add_milestone">Add Milestone</a></li>
                            </ul>
                        </div>
                    @endif

                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>


            </div>
            <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover" style=" color: #0c0c0c;">
            <tr>
                <th>Numéro</th>
                <th>Genre</th>
                <th>Commentaire</th>
                <th>Due</th>
                <th>Dependance</th>
                <th>Actif</th>
                <th>Dependant</th>
                <th>Livrable Type</th>

            </tr>
            @foreach($project->milestones()->get() as $milestone)
                <tr>
                    <td> {{$milestone->numero}}</td>
                    <td>{{$milestone->genre}}</td>
                    <td>{{$milestone->commentaire}}</td>
                    <td>{{$milestone->due}}</td>
                    <td>{{$milestone->dependance}}</td>
                    <td>{{$milestone->actif}}</td>
                    <td>{{$milestone->dependant}}</td>
                    <td>{{$milestone->livrable_type}}</td>
                    <td>@if(Auth::user()->role == 'admin') <a href="/milestones/delete/{{$milestone->id}}"><i class="ion ion-android-delete pull-right"></i></a>@endif</td>
                </tr>
            @endforeach


        </table>
    </div>

            <!-- /.box-body -->
            <div class="box-footer" style="display: none;" id="add_milestone_form">
                {!! Form::open(["url"=>"/milestones/add/".$project->id,'method'=>'POST']) !!}
                <div class="form-group">
                    {!! Form::text('numero',null,['class'=>'form-control','placeholder'=>'Milestone Number']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('genre',null,['class'=>'form-control','placeholder'=>'Milestone Genre']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('commentaire',null,['class'=>'form-control','placeholder'=>'Milestone Description']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('actif',null,['class'=>'form-control','placeholder'=>'Actif ? ']) !!}
                </div>
                 <div class="form-group">
                    {!! Form::text('livrable_type',null,['class'=>'form-control','placeholder'=>'Livrable type ']) !!}
                </div>
                  <div class="form-group">
                    {!! Form::text('dependance',null,['class'=>'form-control','placeholder'=>'Dependencies ']) !!}
                </div>
                <div class="form-group">
                    {!! Form::input('fin','due',date('Y-m-d'),['class'=>'form-control','placeholder'=>'Due date ']) !!}
                </div>

                <div class="form-group">
                    {!! Form::select('dependant',$milestones_lists,null,['class'=>'form-control','id'=>'milestones_list_select']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Add Milestone',['class'=>'form-control btn btn-success btn-block']) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>

        {{--TASKS--}}
<div id="project_tasks" class="box box-danger ">
    <div class="box-header">
        <i class="ion ion-compose"></i>

        <h3 class="box-title">Tasks</h3>
        <div class="pull-right box-tools">
            <!-- button with a dropdown -->
            @if(Auth::user()->role == 'admin')
            <div class="btn-group">
                <button type="button" title="More" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a  id="add_task_form">Add Task</a></li>
                    {{--<li><a href="#">Delete Task</a></li>--}}

                </ul>
            </div>
            @elseif(User::find(Auth::user()->id)->roles()->where(['role_id'=>2,'project_id'=>$project->id])->exists())
                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bars"></i></button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a  id="add_task_form">Add Task</a></li>
                        {{--<li><a href="#">Delete Project</a></li>--}}

                    </ul>
                </div>
            @endif

            <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>


    </div>
    <!-- /.box-header -->

    <div class="box-body table-responsive no-padding">
        <table class="table table-hover" style="color: #0c0c0c;">
            <tr>
                <th>Object</th>
                <th>Description</th>
                <th>Status</th>
                <th>Transmitter</th>
                <th>Assigned</th>
                <th></th>

            </tr>
            @foreach($project->tasks()->get() as $task)
                <tr>
                    <td> {{$task->object}}</td>
                    <td>{{$task->description}}</td>
                    <td>{{$task->status}}</td>
                    <td>{{User::find($task->transmitter)['name']}}</td>
                    <td>{{User::find($task->assigned)['name']}}</td>
                    <td> @if(Auth::user()->role == 'admin') <a href="/tasks/{{$task->id}}/delete/{{$project->id}}"><i class="ion ion-android-delete pull-right"></i></a>@endif</td>
                </tr>
            @endforeach


        </table>
    </div>



    <!-- /.box-body -->

</div>


        {{--RISKS--}}
<div id="project_risks" class="box box-warning ">
            <div class="box-header">
                <i class="ion ion-android-warning"></i>

                <h3 class="box-title">Risks</h3>
                <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    @if(Auth::user()->role == 'admin')
                    <div class="btn-group">
                        <button type="button" title="More" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i></button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a  id="add_risk_form">Add Risk</a></li>
                            {{--<li><a href="#">Delete Project</a></li>--}}

                        </ul>
                    </div>
                    @elseif(User::find(Auth::user()->id)->roles()->where(['role_id'=>2,'project_id'=>$project->id])->exists())
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bars"></i></button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a  id="add_risk_form">Add Risk</a></li>
                                {{--<li><a href="#">Delete Project</a></li>--}}

                            </ul>
                        </div>
                    @endif

                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>


            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                        <table class="table table-hover" style=" color: #0c0c0c;">
                            <tr>
                                <th>Libelle</th>
                                <th>Commentaire</th>
                                <th>Famille</th>
                                <th>Actif</th>
                                <th>Writer</th>
                                <th>Severity</th>
                                <th>Mesure Type</th>
                                <th></th>

                            </tr>
                            @foreach($project->risks()->get() as $risk)
                                <tr>
                                    <td> {{$risk->libelle}}</td>
                                    <td>{{$risk->commentaire}}</td>
                                    <td>{{$risk->famille}}</td>
                                    <td>{{$risk->actif}}</td>
                                    <td>{{Auth::user()->name}}</td>
                                    <td>{{$risk->severite}}</td>
                                    <td>{{$risk->type_mesure}}</td>
                                    <td>     @if(Auth::user()->role == 'admin') <a class="deleteRISK" title="delete risk" href="/risks/{{$risk->id}}/delete/{{$project->id}}"><i class="ion ion-android-delete pull-right"></i></a>@endif</td>
                                </tr>
                            @endforeach


                        </table>



            </div>
            <!-- /.box-body -->


        </div>

        {{--FILES--}}
<div id="project_files" class=" box box-success">
            <div class="box-header">
                <i class="ion ion-ios-folder"></i>

                <h3 class="box-title">Files</h3>
                <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    @if(Auth::user()->role == 'admin')
                        <div class="btn-group">
                            <button type="button" title="More" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bars"></i></button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a  class="add_file">Add File</a></li>
                                {{--<li><a href="#">Delete Task</a></li>--}}

                            </ul>
                        </div>
                    @elseif(User::find(Auth::user()->id)->roles()->where(['role_id'=>2,'project_id'=>$project->id])->exists())
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bars"></i></button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a  class="add_file">Add File</a></li>
                                {{--<li><a href="#">Delete Project</a></li>--}}

                            </ul>
                        </div>
                    @endif

                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>

            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" style="color: #0c0c0c;">
                    <tr>
                        <th>ID</th>
                        <th>Filename</th>
                        <th>Project</th>
                        <th>By</th>
                        <th>Uploader on</th>
                        <th></th>

                    </tr>
                    @foreach($project->files()->get() as $file)
                        <tr>
                            <td> {{$file->id}}</td>
                            <td>{{$file->name}}</td>
                            <td>{{Project::find($file->project_id)->libelle }}</td>
                            <td>{{ User::find($file->uploader_id)->name  }}</td>
                            <td>{{ $file->created_at->toDateTimeString()  }}</td>
                            <td>@if(Auth::user()->role == 'admin') <a href="/files/{{$file->id}}/delete/{{$project->id}}"><i class="ion ion-android-delete pull-right"></i></a>@endif
                            </td>
                        </tr>
                    @endforeach


                </table>
            </div>
            <div class="box-footer">


            </div>
        </div>

        {{--MEMBERS--}}
<div id="project_members" class="box box-default">
            <div class="box-header">
                <i class="ion ion-person-stalker"></i>

                <h3 class="box-title">Members</h3>
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <div id="users">
                <ul class="users-list clearfix">
                    @foreach($project->users()->get() as $member)
                        <li>
                            <img width="72" height="75" src="/img/{{$member->logo}}" alt="">
                            <a style="text-decoration: underline;" href="/profile/{{$member->id}}" class="users-list-name">{{$member->name}}</a>
                            @foreach($member->roles()->where('project_id',$project->id)->get() as $role)
                                <b>{{ $role->name }}</b><br>
                                @endforeach
                        </li>

                    @endforeach
                </ul>
                </div>
            </div>

        </div>

        {{--Budget and Collaborations SECTION--}}
        <div class="row">
             <div class="col-lg-6">
<div id="project_collaborations" class="box box-default">
    <div class="box-header">
        <i class="ion ion-android-person-add"></i>

        <h3 class="box-title">Collaborations</h3>
        <div class="pull-right box-tools">
            @if(Auth::user()->role == 'admin')
                <div class="btn-group">
                    <button type="button" title="More" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bars"></i></button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a  data-toggle="modal" data-target="#add_collaboration_form">Add Collaboration</a></li>

                    </ul>
                </div>
            @elseif(User::find(Auth::user()->id)->roles()->where(['role_id'=>2,'project_id'=>$project->id])->exists())
                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bars"></i></button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a   data-toggle="modal" data-target="#add_collaboration_form">Add Collaboration</a></li>

                    </ul>
                </div>
            @endif
            <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="box-body no-padding">
        <table class="table table-hover" style=" color: #0c0c0c;">
            <tr>
                <th>Emetteur</th>
                <th>Sujet</th>
                <th>Message</th>
                <th>Date declarée</th>

                <th></th>

            </tr>
            @foreach($project->collaborations()->get() as $collaboration)
                <tr>
                    <td> {{$collaboration->emetteur}}</td>
                    <td>{{$collaboration->sujet}}</td>
                    <td>{{$collaboration->message}}</td>
                    <td>{{$collaboration->date_declaree}}</td>

                    <td>@if(Auth::user()->role == 'admin') <a  title="delete collaboration" href="/collaboration/{{$collaboration->id}}/delete/{{$project->id}}"><i class="ion ion-android-delete pull-right"></i></a>@endif</td>
                </tr>
            @endforeach


        </table>
    </div>
    <div class="box-footer">
        <div id="add_collaboration_form" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Collaboration</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url'=>'/collaboration/add/'.$project['id']]) !!}
                        <div class="form-group">
                            {!! Form::label('emetteir','Emetteur : ') !!}
                            {!! Form::text('emetteur',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('sujet','Sujet : ') !!}
                            {!! Form::text('sujet',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('message','Message : ') !!}
                            {!! Form::text('message',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('date_declaree','Date declarée : ') !!}
                            {!! Form::input('date','date_declaree',date('Y-m-d'),['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Add Collaboration',['class'=>'form-control btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
             </div>
             <div class="col-lg-6">
<div id="project_budget" class="box box-default">
    <div class="box-header">
        <i class="ion ion-social-usd"></i>

        <h3 class="box-title"> Budget</h3>
        <div class="pull-right box-tools">
            @if(Auth::user()->role == 'admin')
                <div class="btn-group">
                    <button type="button" title="More" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bars"></i></button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a  data-toggle="modal" data-target="#add_budget_form">Edit budget</a></li>

                    </ul>
                </div>
            @elseif(User::find(Auth::user()->id)->roles()->where(['role_id'=>2,'project_id'=>$project->id])->exists())
                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bars"></i></button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a   data-toggle="modal" data-target="#add_budget_form">Edit budget</a></li>

                    </ul>
                </div>
            @endif
            <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="box-body no-padding">
        <ul class="list-group">
            <li class="list list-group-item"><b>Libelle :</b> {{ $project->cout['libelle']  }}</li>
            <li class="list list-group-item"> <b>Profil moyen humains (Dhs) :</b> {{$project->cout['pmh']}}</li>
            <li class="list list-group-item"><b>Budget cible alloué (Dhs) :</b> {{$project->cout['bca']}} </li>
            <li class="list list-group-item"><b> Actif : </b>{{$project->cout['actif']}} </li>
            <li class="list list-group-item"><b>Commenatire :</b> {{$project->cout['commentaire']}} </li>
        </ul>

    </div>
    <div class="box-footer">
        <div id="add_budget_form" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Collaboration</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::model($project->cout()->first(),['url'=>'/projects/budget/' . $project->id .'/edit/'.$project->cout['id']]) !!}
                        <div class="form-group">
                            {!! Form::label('libelle','Libelle: ') !!}
                            {!! Form::text('libelle',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('pmh','Profil moyen humains (Dhs) : ') !!}
                            {!! Form::text('pmh',null,['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('bca','Budget cible alloué  (Dhs): ') !!}
                            {!! Form::text('bca',null,['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('actif','Actif : ') !!}
                            {!! Form::text('actif',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('commentaire','Commentaire : ') !!}
                            {!! Form::text('commentaire',null,['class'=>'form-control']) !!}
                        </div>


                        <div class="form-group">
                            {!! Form::submit('Edit Budget',['class'=>'form-control btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
             </div>
        </div>

</div>

{{--END PROJECT STUFF--}}


        <a><img style="position: absolute; left: 85%; bottom:50px;" id="gotop" src="/img/gotop1.png" width="74" height="77" title="Go Top" ></a>
    </div>





@stop

@section('script')
    <script>
        $('#milestones_list_select').select2({
            'width':'100%',
            'placeholder':'choose milestones '
        });
        $('.add_milestone').click(function(){
            $('#add_milestone_form').slideDown(300);
        } );
        $('.deleteRISK').tooltip();
        $('#milestone').click(function(){
            $('body,html').animate({
                scrollTop: $('#project_milestones').offset().top
            }, 800);
        }).tooltip().hover(function () {
            $(this).css('cursor','pointer');
        });
        $('#risk').click(function(){
            $('body,html').animate({
                scrollTop: $('#project_risks').offset().top
            }, 800);
        }).tooltip().hover(function () {
            $(this).css('cursor','pointer');
        });
         $('#user').click(function(){
            $('body,html').animate({
                scrollTop: $('#project_members').offset().top
            }, 800);
        }).tooltip().hover(function () {
             $(this).css('cursor','pointer');
         });
        $('#task').click(function(){
            $('body,html').animate({
                scrollTop: $('#project_tasks').offset().top
            }, 800);
        }).tooltip().hover(function () {
            $(this).css('cursor','pointer');
        });
        $('#budget').click(function(){
            $('body,html').animate({
                scrollTop: $('#project_budget').offset().top
            }, 800);
        }).tooltip().hover(function () {
            $(this).css('cursor','pointer');
        });
        $('#collaboration').click(function(){
            $('body,html').animate({
                scrollTop: $('#project_collaborations').offset().top
            }, 800);
        }).tooltip().hover(function () {
            $(this).css('cursor','pointer');
        });
         $('#file').click(function(){
            $('body,html').animate({
                scrollTop: $('#project_files').offset().top
            }, 800);
        }).tooltip().hover(function () {
           $(this).css('cursor','pointer');
         });
        $('#gotop').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
        }).hover(function(){
            $(this).parent().css('cursor','pointer');
            $(this).attr('src','/img/gotop.png');
        },function () {
            $(this).attr('src','/img/gotop1.png');
        }).tooltip();
        $('.button[data-toggle="dropdown"]').tooltip();


        $('#add_task_form').click(function () {
//            $('#add_todo_shit').click(function () {

            bootbox.dialog({
                title: 'Add Your TODO item ',
                message:
                '<div style="width:80%; margin:auto; ">'+
                '<form action="/tasks/add/'+ project_id +'" class="form-horizontal" method="POST" > ' +
                '<div class="form-group"> ' +
                '<input type="hidden" name="_token" value="{{csrf_token()}}"' +
                '</div> ' +
                '<div class="form-group"> ' +
                '<input name="object" type="text" placeholder="Task Object" value="Task '+ totalTasks +'" class="form-control "> ' +
                '</div> ' +
                '<div class="form-group"> ' +
                '<input name="description" type="text" placeholder="Task Description" class="form-control "> ' +
                '</div> ' +
                '<div class="form-group"> ' +
                '<input name="priority" type="text" placeholder="Task priority" class="form-control "> ' +
                '</div> ' +
                '<div class="form-group"> ' +
                '<input name="category" type="text" placeholder="Task category" class="form-control "> ' +
                '</div> ' +
                '<div class="form-group"> ' +
                '<input name="risk" type="text" placeholder="Task risk" class="form-control "> ' +
                '</div> ' +
                '<div class="form-group"> ' +
                '<input name="status" type="text" placeholder="Task status" class="form-control "> ' +
                '</div> ' +
                '<div class="form-group"> ' +
                '<label for="assigned">Assinged Person</label> ' +
                        '{!! Form::select('assigned',User::all()->lists('name','id'),1,['class'=>'form-control']) !!}'+

                        '</div> ' +
                '<div class="form-group"> ' +
                '<input  type="date" name="start" value="{{\Carbon\Carbon::now()->toDateString()}}" class="form-control">'+
                '</div>' +
                '<div class="form-group"> ' +
                '<input  type="date" name="due" value="{{\Carbon\Carbon::tomorrow()->toDateString()}}" class="form-control">'+
                '</div>' +
                '<div class="form-group"> ' +
                '<input type="submit"  value="Add Task" class="form-control btn btn-success btn-block">'+
                '</div>' +
                '</form></div>'

            });

        });

        $('#add_risk_form').click(function () {
//            $('#add_todo_shit').click(function () {

            bootbox.dialog({
                title: 'Add Your Risk ',
                message:
                '<div style="width:80%; margin:auto; ">'+
                '<form action="/risks/add/'+ project_id +'" class="form-horizontal" method="POST" > ' +
                '<div class="form-group"> ' +
                '<input type="hidden" name="_token" value="{{csrf_token()}}"' +
                '</div> ' +
                '<div class="form-group"> ' +
                '<input name="libelle" type="text" placeholder="Risk libelle"  class="form-control "> ' +
                '</div> ' +
                '<div class="form-group"> ' +
                '<input name="commentaire" type="text" placeholder="Risk Description" class="form-control "> ' +
                '</div> ' +
                '<div class="form-group"> ' +
                '<input name="famille" type="text" placeholder="Famille risk" class="form-control "> ' +
                '</div> ' +
                '<div class="form-group"> ' +
                '<input name="severite" type="text" placeholder="Task Severity" class="form-control "> ' +
                '</div> ' +
                '<div class="form-group"> ' +
                '<input name="actif" type="text" placeholder="Actif ou non" class="form-control "> ' +
                '</div> ' +
                '<div class="form-group"> ' +
                '<input name="type_mesure" type="text" placeholder="Type mesure" class="form-control "> ' +
                '</div> ' +

                '<div class="form-group"> ' +
                '<input type="submit"  value="Add Task" class="form-control btn btn-success btn-block">'+
                '</div>' +
                '</form></div>'

            });

        });


        $('.add_file').click(function () {
//            $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
//            $('#add_file_form').slideDown(300);
            bootbox.dialog({
                title :'Upload file :',
                message: '<div style="width:80%; margin:auto; ">'+
                '<form action="/apply/upload/'+ project_id +'" class="form-horizontal" method="POST" enctype="multipart/form-data" > ' +
                '<div class="form-group"> ' +
                '<input type="hidden" name="_token" value="{{csrf_token()}}"' +
                '</div> ' +
                        '<b>Note : </b> You can upload jpeg,bmp,png,pdf,txt and for max size 10mb'+
                '<div class="form-group"> ' +
                '<input name="image" type="file"   > ' +
                '</div> ' +


                '<div class="form-group"> ' +
                '<input type="submit"  value="Upload file" class="form-control btn btn-success btn-block">'+
                '</div>' +
                '</form></div>'

            });
        });
    </script>
@stop