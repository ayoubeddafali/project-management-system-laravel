@extends('layouts.master3')

@section('content')

    <div id="content">


        <ul class="nav nav-tabs" style="  border: 0px hidden;">
            <li role="presentation" class="presentation" id="active_by_default"><a href="/tasks/index">My Tasks </a></li>
            <li role="presentation" class="presentation active"><a href="/task/transmitted">My Transmitted Tasks </a></li>
        </ul>
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Tasks / <small>My Tasks :</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" style="font-family:'Lucida Grande', sans-serif">
                    <tr>
                        <th>Object</th>
                        <th>Description</th>
                        <th>Project </th>
                        <th>Assigned</th>
                        <th>Status</th>
                        <th>Start</th>
                        <th>Due</th>
                        <th></th>
                    </tr>
                    @foreach($transmitted_tasks as $myTask)
                        <tr>
                            <td>{{$myTask->object}}</td>
                            <td>{{ $myTask->description }}</td>
                            <td> {{$myTask->project->libelle}} </td>
                            <td>{{User::find($myTask->assigned)->name}}</td>
                            <td><{{$myTask->status}}/td>
                            <td> {{$myTask->start->toDateString()}} </td>
                            <td>{{$myTask->due->diffForHumans(\Carbon\Carbon::now())}}</td>
                            <td><a href="/tasks/{{$myTask->id}}/delete"><img  title="delete" src="/img/delete.png" alt="modify"></a>
                        </tr>
                    @endforeach


                </table>
            </div>
        </div>
    </div>

@stop


