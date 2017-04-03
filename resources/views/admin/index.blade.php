@extends('layouts.master3')

@section('content')

    <div id="content">


        <ul class="nav nav-tabs" style="  border: 0px hidden;">
            <li role="presentation" class="presentation active" id="active_by_default"><a href="/admin">Gestion des projets</a></li>
            <li role="presentation" class="presentation"><a href="/admin/users">Gestion des utilisateurs</a></li>
        </ul>
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Gestion / <small>Gestion des projets</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" style="font-family:'Lucida Grande', sans-serif">
                    <tr>
                        <th>ID</th>
                        <th>Libelle</th>
                        <th>Chef</th>
                        <th>Status</th>
                        <th>Due</th>
                        <th></th>
                    </tr>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{$project['id']}}</td>
                            <td>{{ $project['libelle'] }}</td>
                            <td>{{User::find($project['chef'])['name']}}</td>
                            <td> {!! Status::find($project['status'])['name'] !!} </td>
                            <td>{{$project['fin']}}</td>
                            <td><a href="/projects/{{$project['id']}}/edit"><img  title="edit" src="/img/modify.png" alt="modify"></a>
                                <a href="/projects/{{$project['id']}}/delete"><img src="/img/delete.png" id="delete_project" title="delete" alt="delete"></a></td>
                        </tr>
                    @endforeach


                </table>
            </div>
        </div>

@stop


