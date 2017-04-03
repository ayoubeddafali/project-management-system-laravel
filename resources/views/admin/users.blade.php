@extends('layouts.master3')

@section('content')

    <div id="content">

        <h3 class="box-title" style="color: whitesmoke">Gestion / <small>Gestion des utilisateurs </small></h3>

        <ul class="nav nav-tabs" style="  border: 0px hidden; margin-bottom: 10px">
            <li role="presentation" class="presentation" id="active_by_default"><a href="/admin">Gestion des projets</a></li>
            <li role="presentation" class="presentation active"><a href="/admin/users">Gestion des utilisateurs</a></li>
            <a id="addUser" style="position: relative ; right:-350px;" href="/profile/create" class="btn btn-success "><i class="fa fa-plus-circle"></i> Add  User </a>
        </ul>
    @foreach($users as  $member)
        <div class="box box-solid bg-blue-gradient "  style="width: 32%;
    /*float: left;*/
    display: inline-block;
    vertical-align: top;
    height: auto;
    padding-bottom: 10px;
    margin-right: 10px;
    margin-bottom: 10px;
    text-indent: 15px;
    font-family:monospace;">
            <div class="box-header">
                <h3 class="box-title">
                    {{ ucfirst( $member['name'])}}
                </h3>
                <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i></button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="/profile/{{$member['id']}}">View Profile</a></li>
                            <li><a href="/profile/{{$member['id']}}/edit">Edit Profile</a></li>
                            <li><a href="/users/{{$member['id']}}/delete">Delete Profile</a></li>
                            <li class="divider"></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="slimScrollDiv box-body no-padding">
                <div class="pull-right image">
                <img width="110px" height="125px" class="img-circle" src="/img/{{$member['logo']}}"  alt="">
                </div>
                <label style="color:#222D32;">Email :</label>
                <p>{{$member['email']}}</p>
                <label style="color:#222D32;">Role :</label>
                <p>{{$member['role']}}</p>



            </div>


        </div>
    @endforeach



@stop


