@extends('layouts.master3')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >


                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ ucfirst($user->name)  }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="/img/{{$user->logo}}" class="img-circle img-responsive"> </div>


                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>ID :</td>
                                        <td>{{$user->id}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email :</td>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Role :</td>
                                        <td>{{$user->role}}</td>
                                    </tr>

                                    <tr>
                                        <td>Member Since :</td>
                                        <td>{{ $user->created_at->format('l jS \\of F Y h:i:s A') }}</td>
                                    </tr>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <span class="pull-right">
                            <a href="/profile/{{$user->id}}/edit" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                        </span>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection