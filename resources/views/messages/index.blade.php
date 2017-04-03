@extends('layouts.master3')

@section('content')

    <div id="content">


        <ul class="nav nav-tabs" style="  border: 0px hidden;">
            <li role="presentation" class="presentation active" id="active_by_default"><a href="/messages/all">Received Messages</a></li>
            <li role="presentation" class="presentation"><a href="/messages/sent">Sent Messages</a></li>
        </ul>
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Messages / <small>Inbox</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table  class="table table-hover" style="font-family:'Lucida Grande', sans-serif">
                    <tr>

                        <th>From</th>
                        <th>Subject</th>
                        <th>Messagee</th>
                        <th>Sent At </th>
                        <th></th>
                    </tr>
                    @foreach($inboxs as $inbox)
                        <tr>
                            <td>{{User::find($inbox->from)->email}}</td>
                            <td>{{ $inbox->subject }}</td>
                            <td>{{$inbox->content}}</td>
                            <td>{!! $inbox->created_at->toDateTimeString() !!}</td>
                            {{--<td>{{$project['fin'] - $project['debut']}}</td>--}}
                            <td><a href="/messages/{{$inbox->id}}/delete"><img  title="edit" src="/img/delete.png" alt="modify"></a>
                        </tr>
                    @endforeach


                </table>
            </div>
        </div>

@stop


