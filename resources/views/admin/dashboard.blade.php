@extends('layouts.master3')



@section('content')
    @if(Session::has('info'))

        <div class="alert alert-success bounceInLeft">
           Welcome <b>{{Session::get('info')}}</b>
        </div>

    @endif

    @if(Session::has('success'))

        <div class="alert alert-warning " >
            {{Session::get('success')}}
        </div>

    @endif


    <section class="content-header">
        <h1 style="color:#CCCCCC ">
            Dashboard /
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/" style="color: #CCCCCC ;"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{count($projects)}} </h3>
                        @if(Auth::user()->role == 'admin')
                            <p>Total Projects</p>
                        @else
                            <p>My Projects</p>
                        @endif

                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="/projects" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{count($tasks)}}</h3>

                        <p>Tasks</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-paper"></i>
                    </div>
                    <a href="/tasks/index" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            @if(Auth::user()->role == 'admin')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        {{--<h3>{{count(\App\User::all()->toArray())}}</h3>--}}
                        <h3>3</h3>
                        <p>Reports</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="/reports" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                            <h3>3</h3>
                        <p>Settings</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-settings"></i>
                    </div>
                    <a href="/admin" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endif
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
            {{--DashBoard Project With Risks Status etc --}}
            <section class="col-lg-12">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Projects </h3>
                        <div class="pull-right box-tools">
                            <!-- button with a dropdown -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bars"></i></button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li><a href="/calendar">View calendar</a></li>
                                    <li  class="divider"></li>
                                    <li><a href="/export">Export to CSV</a></li>
                                    <li><a href="">Export to PDF</a></li>
                                </ul>
                            </div>
                            <button  type="button" title="more" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" title="remove" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered table-striped" style="font-family:'Lucida Grande', sans-serif ; color: #0c0c0c;">
                            <tr>
                                <th>ID</th>
                                <th>Libelle</th>
                                <th>Chef</th>
                                <th>Status</th>
                                <th>Due</th>
                                <th>Risks</th>
                                <th>Budget</th>
                                <th></th>
                            </tr>
                            @foreach($projects as $project)
                                 <tr>
                                    <td> {{$project['id']}}</td>
                                    <td><a href="/projects/{{$project['id']}}">{{ $project['libelle'] }}</a></td>
                                    <td>{{User::find($project['chef'])['name']}}</td>
                                    <td>{{Status::find($project['status'])['name']}}</td>
                                    <td>{{$project['fin']}}</td>
                                     <td>  <p class="more_risks"><a style="text-decoration: underline">More</a> <input type="hidden" value="{{$project['id']}}"> </p>  </td>
                                     <td> <p class="more_couts"><a style="text-decoration: underline">More</a> <input type="hidden" value="{{$project['id']}}">  </td>
                                  </tr>
                            @endforeach


                        </table>
                    </div>
                </div>
            </section>
        </div>
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">

                {{--TODO SECTION--}}
                <section class="col-lg-6">
                <div class="box box-danger">
                    <div class="box-header">
                        <i class="ion ion-clipboard"></i>

                        <h3 class="box-title">Mes Notes</h3>
                        <div class="pull-right box-tools">
                            <!-- button with a dropdown -->

                            <button type="button" title="more" class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button"  class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>


                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="todo-list">
                            @foreach($todos as $todo)
                            <li>
                                <!-- drag handle -->
                          <span class="handle">
                            <i class="fa fa-ellipsis-v"></i>
                            <i class="fa fa-ellipsis-v"></i>
                          </span>

                                <!-- todo text -->
                                <span class="text">{{ $todo->description  }}</span>
                                <!-- Emphasis label -->
                                <small class="label label-danger"><i class="fa fa-clock-o"></i> {{$todo->due->diffForHumans(\Carbon\Carbon::now())}} </small>
                                <!-- General tools such as edit or delete-->

                                <div class="tools">

                                    {{--<button type="button"  class="btn btn-danger btn-sm shitty" data-toggle="modal"  data-target="#edit_todo_form"><i class="fa fa-edit"></i></button>--}}



                                    <a id="delete_todo" href="/admin/todo/{{$todo->id}}/delete">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </li>

                            @endforeach

                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix no-border">
                        <button id="add_todo_shit" type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#add_todo_form"><i class="fa fa-plus"></i> Add item</button>
                        <div id="add_todo_form" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add note</h4>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::open(['url'=>'/admin/'. $user['id'] .'/addTodo']) !!}
                                        <div class="form-group">
                                            {!! Form::label('description','Description : ') !!}
                                            {!! Form::text('description',null,['class'=>'form-control','required']) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('due','Due Date : ') !!}
                                            {!! Form::input('date','due',\Carbon\Carbon::tomorrow()->toDateString(),['class'=>'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::submit('Add Todo',['class'=>'form-control btn btn-success']) !!}
                                        </div>
                                        {!! Form::close() !!}

                                    </div>

                                </div>

                            </div>
                        </div>





                    </div>
                </div>
                </section>
                {{--Quick Message Section--}}
                <section class="col-lg-6">
                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-envelope"></i>

                        <h3 class="box-title">Quick Message</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <!-- button with a dropdown -->

                            <button type="button" title="more" class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button"  class="btn btn-info btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <div class="box-body">
                        {!! Form::open(['action'=>'adminController@sent_message']) !!}
                        <div class="form-group">
                            {!! Form::select('toWhom',$membersExceptMe ,null,['id'=>'members_mails','class'=>'form-control','placeholder'=>'type email or choose if exists in the list']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::text('subject',null,['class'=>'form-control','placeholder'=>'Subject','required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::textarea('content',null,['id'=>'quickmailarea','width'=>'100%','height'=>'125px','class'=>'form-control','placeholder'=>'Body','required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Send',['id'=>'sendEmail','class'=>'pull-right btn btn-default']) !!}
                        </div>
                        {!! Form::close() !!}

                    </div>

                </div>
                </section>

            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <!-- right col -->
        </div>
        <!-- /.row (main row) -->

    </section>
@stop


@section('script')
    <script>

//        $(document).on("click", ".shitty", function (e) {
//
//            e.preventDefault();
//
//            var _self = $(this);
//
//            var todo = _self.data('id');
//            $("#bookId").val(myBookId);
//
//            $(_self.attr('href')).modal('show');
//        });
//        $('#todo_date').datepicker();
        {{--$('#add_todo_shit').click(function () {--}}

            {{--bootbox.dialog({--}}
                        {{--title: 'Add Your TODO item ',--}}
                        {{--message:--}}
                        {{--'<div style="width:80%; margin:auto; ">'+--}}
                        {{--'<form action="/admin/'+ user_id +'/addTodo" class="form-horizontal" method="POST" > ' +--}}
                        {{--'<div class="form-group"> ' +--}}
                        {{--'<input type="hidden" name="_token" value="{{csrf_token()}}"' +--}}
                        {{--'</div> ' +--}}
                        {{--'<div class="form-group"> ' +--}}
                        {{--'<label for="description">Description</label> ' +--}}

                        {{--'<input id="description" name="description" type="text" placeholder="Your description" class="form-control "> ' +--}}
                        {{--'</div> ' +--}}
                        {{--'<div class="form-group"> ' +--}}
                        {{--'<label for="todo_date">Due Date</label> ' +--}}
                        {{--'<input id="todo_date" type="date" name="due" value="{{\Carbon\Carbon::now()->toDateString()}}" class="form-control">'+--}}
                        {{--'</div>' +--}}
                        {{--'<div class="form-group"> ' +--}}
                        {{--'<input type="submit"  value="Add Todo" class="form-control btn btn-success btn-block">'+--}}
                        {{--'</div>' +--}}
                        {{--'</form></div>'--}}

                    {{--});--}}

        {{--});--}}
//        $('#add_todo').click(function(){
//            $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
//            $('.add_todo_form').slideDown(300);
//        });

        var risks = {!! json_encode($risks) !!};
        var projects = {!! json_encode($projects) !!};
        var budgets = {!! json_encode($budgets) !!};



        $('#members_mails').select2({
            placeholder:'type the email and press enter ',
            'tags':true
        });


        $('.more_risks').click(function() {
            var id = $(this).find('input').val();
            var searched_risks = [];
            for (var i=0 ; i < risks.length ; i++ ){
                if (risks[i].project_id == id ){
                    searched_risks.push(risks[i]);
                }
            }

            console.log(searched_risks);
            var message = [];
            for (var k = 0 ; k < 2 ; k++ ){
                if(k < searched_risks.length){
                message[k] ="<div style=\" font-size: 16px;font-family: monospace; \"  class=\"alert alert-success\"'>Risk " + k  + "<ul><li> libelle : " + searched_risks[k].libelle  + "</li>" +
                "<li>  Commentaire : " + searched_risks[k].commentaire +  "</li>" +
                "<li> Sevirité : " + searched_risks[k].severite + "</li><ul></div><br>" ;
                }
            }
            console.log(typeof message.join('<br>'));
            var text = message.join('<br>');
            if(text.length == 0 ){
                text = "<b>No Availabe Risks in This Project</b>"
            }

            bootbox.dialog({
                title: "<i class='ion ion-alert-circled'> </i> Project Risks",
                message:  text + "<br><a href='/projects/" + id +"/#project_risks'>Click here to see all details </a>"

            });
        });

        $('.more_couts').click(function () {

            var id = $(this).find('input').val();
            var selected_project = {};

            projects.forEach(function(project){
                if (project.id == id){
                    selected_project = project;
                }

            });
            if (selected_project.cout_id == 1){
                bootbox.dialog({
                    title :'Budget Section',
                    message:
                        '<div class="alert alert-danger">' +
                                '<p><b>No budget</b></p>'+

                        '</div>'+
                        '<a  onclick="addBudget();" class="btn btn-success btn-block">Click here to add one</a>'+
                        '</div>'+


                        '<div id="budget_form" class="list-group-item list-group-item-default panel-footer" style="display:none;">' +
                        '<form action="/projects/' + selected_project.id + '/budget" method="POST" > ' +
                        '<div class="form-group"> ' +
                        '<input type="hidden" name="_token" value="{{csrf_token()}}"' +
                        '</div> ' +


                        '<div class="form-group">'+
                        '<input style="width:80%;margin:auto;"  name="libelle" type="text" placeholder="libelle"  class="list-group-item  form-control "> ' +
                        '</div>'+
                        '<div class="form-group">'+
                        '<input style="width:80%;margin:auto;" type="text" name="pmh"  placeholder="Profil moyen humain(Dhs)" class="list-group-item  form-control"></textarea> ' +
                        '</div>'+
                        '<div class="form-group">'+
                        '<input style="width:80%;margin:auto;" type="text" name="bca"  placeholder="Budget Cible Alloué(Dhs)" class="list-group-item  form-control"></textarea> ' +
                        '</div>'+
                        '<div class="form-group">'+
                        '<input style="width:80%;margin:auto;" type="text" name="actif"  placeholder="Actif ?" class="list-group-item  form-control"></textarea> ' +
                        '</div>'+
                        '<div class="form-group">'+
                        '<textarea style="width:80%;margin:auto;"  name="commentaire"  placeholder="Commentaire" class="list-group-item  form-control"></textarea> ' +
                        '</div>'+
                        '<div class="form-group">'+
                        '<input style="width:80%; margin:auto;" type="submit"  value="Send" class="list-group-item form-control btn btn-success btn-block">'+
                        '</div>' +
                        '</form>'+



                        '</div>'

                });
            }
            else {
                var searched_budgets = [];
                for (var i=0 ; i < budgets.length ; i++ ){
                    if (budgets[i].id == selected_project.cout_id ){
                        searched_budgets.push(budgets[i]);
                    }
                }
                console.log(searched_budgets);
                var message = [];
                for (var k = 0 ; k < 2 ; k++ ){
                    if(k < searched_budgets.length){
                        message[k] ="<div style=\" font-size: 16px;font-family: monospace; \" class='alert alert-success'><ul><li> libelle : " + searched_budgets[k].libelle  + "</li>" +
                                "<li>  Commentaire : " + searched_budgets[k].commentaire +  "</li>" +
                                "<li> Actif : " + searched_budgets[k].actif + "</li><ul></div><br>" ;
                    }
                }
                console.log(message);
                var text = message.join('<br>');

                bootbox.dialog({
                    title : 'Budget section ',
                    message :text + "<br><a href='/projects/" + selected_project.id +"/#project_budget'>Click here to see all details </a>"
                });
            }


        });
        function addBudget() {
            $('#budget_form').slideDown(300);
        }

    </script>
    @stop