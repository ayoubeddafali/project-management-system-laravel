@extends('layouts.master3')

@section('content')
    <div style="border-radius: 5px;" class="no-padding">
        <table class="table table-bordered table-striped " style="padding-bottom: 60px;  font-family:'Lucida Grande', sans-serif ; background-color:#DCDCDC ; color: #0c0c0c;">
            <tr>
                <th>Libelle</th>
                <th>Chef</th>
                <th>Status</th>
                <th>Date de debut </th>
                <th>Date de fin</th>
                <th>Entreprise</th>
                <th>Continent</th>
                <th>Pays</th>
                <th>Site</th>
                <th>Direction</th>
                <th></th>

            </tr>


            @foreach($projects as $project)
                <tr>
                    <td><a style="text-transform: uppercase" href="/projects/{{$project['id']}}">{{$project['libelle']}}</a></td>
                    <td> {{User::find($project['chef'])['name']}}</td>
                    <td>{{Status::find($project['status'])['name']}}</td>
                    <td> {{ $project['debut']  }} </td>
                    <td> {{ $project['fin']  }} </td>
                    <td> {{ $project['entreprise']  }} </td>
                    <td> {{ $project['continent']  }} </td>
                    <td> {{ $project['pays']  }} </td>
                    <td> {{ $project['site'] }} </td>
                    <td> {{ $project['direction']  }} </td>
                    <td>
                        <div style="padding-left: 15px" class="box-tools">
                            <!-- button with a dropdown -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-info  btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bars"></i></button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="/projects/{{$project['id']}}">View Details</a></li>
                                    @if(Auth::user()->role =='admin')
                                        <li><a href="/projects/{{$project['id']}}/edit">Edit Project</a></li>
                                        <li><a href="/projects/{{$project['id']}}/delete">Delete Project</a></li>
                                    @elseif(User::find(Auth::user()->id)->roles()->where(['role_id'=>2,'project_id'=>$project['id']])->exists())
                                        <li><a href="/projects/{{$project['id']}}/edit">Edit Project</a></li>

                                    @endif

                                </ul>
                            </div>

                        </div>
                    </td>
                    </td>

                </tr>
            @endforeach
        </table>
    </div>

    @stop
