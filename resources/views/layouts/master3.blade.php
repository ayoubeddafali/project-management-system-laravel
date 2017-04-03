<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Project Manager</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <!-- You shoould replace it  -->
    {{--<link rel="stylesheet" href="/css/libs/font-awesome.min.css">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    {{--<link rel="stylesheet" href="/plugins/morris/morris.css">--}}
    <!-- jvectormap -->
    <link rel="stylesheet" href="/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <!-- /bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="/css/libs/select2.min.css">
    <link rel="stylesheet" href="/css/libs/animate.css">
    <link rel="stylesheet" href="/css/libs/dncalendar-skin.css">



    @yield('style')
    <link rel="stylesheet" href="/css/style.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    {{--<![endif]-->--}}
</head>
<body class="hold-transition skin-blue sidebar-mini">
@yield('script1')
<div class="wrapper">

    <header class="main-header" id="top_bar">
        <!-- Logo -->
        <a  class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>P</b>MS</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Project</b> Manager</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top " >
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>


            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">{{count(User::find(Auth::user()->id)->messages()->get())}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have {{count(User::find(Auth::user()->id)->messages()->get())}} messages</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    @foreach(User::find(Auth::user()->id)->messages()->limit(4)->orderBy('created_at', 'DESC')->get() as $message)
                                    <li><!-- start message -->
                                        <a class="message_clicked"  >
                                            <i style="display: none;"> {{$message->id}} </i>
                                            <div class="pull-left">
                                                <img src="/img/{{User::find($message->from)->logo}}" class="img-circle" alt="User Image">
                                            </div>

                                            <h4>
                                                {{User::find($message->from)->name}}
                                                <small><i class="fa fa-clock-o"></i>
                                                    {{\Carbon\Carbon::now()->diffForHumans($message->created_at,true)}}</small>
                                            </h4>
                                            <p>{{substr($message->content,0,20)}}...</p>
                                        </a>
                                    </li>
                                    @endforeach
                                    <!-- end message -->

                                </ul>
                            </li>
                            <li class="footer"><a href="/messages/all">See All Messages</a></li>
                        </ul>
                    </li>
                    {{-- Notification --}}
                    <li class="dropdown notifications-menu">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">{{ count(Historic::whereIn('project_id',User::find(Auth::user()->id)->projects()->lists('project_id'))->get()) }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have {{ count(Historic::whereIn('project_id',User::find(Auth::user()->id)->projects()->lists('project_id'))->get()) }} Notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                  @foreach(Historic::whereIn('project_id',User::find(Auth::user()->id)->projects()->lists('project_id'))->limit(5)->orderBy('created_at', 'DESC')->get() as $historic)
                                    <li>
                                        <a>
                                            <i class="fa fa-user text-yellow"></i>
                                            <b>{{ucfirst(User::find($historic['user_id'])->name) }} </b>
                                            <p  > {{ $historic['comment'] }}

                                                @if($historic['project_id'] != '')<em style="display: block;"> {{strtoupper(Project::find($historic['project_id'])['libelle'])}} </em> @endif
                                            </p>
                                        </a>
                                    </li>
                                  @endforeach

                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>

                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">{{ count(\App\Task::where('assigned',Auth::user()->id)->get()) }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have {{ count(\App\Task::where('assigned',Auth::user()->id)->get()) }} tasks</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    @foreach(\App\Task::where('assigned',Auth::user()->id)->get() as $task)
                                    <li><!-- Task item -->
                                        <a >
                                            <h3>
                                                {{$task->description}}
                                                {{--<small class="pull-right">20%</small>--}}
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                            <li class="footer">
                                <a href="/tasks/index">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a  class="dropdown-toggle" data-toggle="dropdown">
                            <img  class="user-image" alt="User Image" src="/img/{{Auth::user()->logo}}">
                            <span class="hidden-xs">{{Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/img/{{Auth::user()->logo}}" class="img-circle" alt="User Image">

                                <p>
                                     {{Auth::user()->name}}
                                    <small>Member since {{ date_format(Auth::user()->created_at,'m/d/Y') }}  </small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="/profile/{{Auth::user()->id}}" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>

        </nav>
    </header>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/img/{{Auth::user()->logo}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active ">
                    <a href="/admin/dashboard">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/calendar">
                        <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">
                @if(Auth::user()->role == 'admin')
                {{count(\App\Project::all()->toArray())}}
                @else
                {{count(User::find(Auth::user()->id)->projects()->get())}}
                @endif

            </small>
                </span>
               </a>
            </li>
            <li>
   <a>
       <i class="fa fa-search"></i> <span>
   <div id="search_box">
       <form >
           <input type="text" id="search" autocomplete="off" class="form-control" placeholder="Search project by name...">

           <div id="result">


           </div>
       </form>

   </div>
           </span>

   </a>

</li>
<li>
   <div id="advanced_search" style="display: none; text-align: center;">
       <a href="/search"><i class="ion ion-alert"></i>
            Advanced search</a>
   </div>
</li>


</ul>
</section>
<!-- /.sidebar -->
</aside>

<div class="content-wrapper">
@include('partials.error')
@yield('content')
@include('partials.footer')

</div>

{{--<div class="control-sidebar-bg"></div>--}}

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/js/libs/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="/plugins/chartjs/Chart.min.js"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="/js/libs/raphael-min.js"></script>
{{--<script src="/plugins/morris/morris.min.js"></script>--}}
<!-- Sparkline -->
<script src="/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
{{--<!-- jQuery Knob Chart -->--}}
<script src="/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="/js/libs/moment.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/plugins/fastclick/fastclick.js"></script>


<!-- AdminLTE App -->
<script src="/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="/dist/js/pages/dashboard.js"></script>--}}
<!-- AdminLTE for demo purposes -->
{{--<script src="/dist/js/demo.js"></script>--}}
<script src="/js/libs/select2.min.js"></script>
<script src="/js/libs/bootbox.min.js"></script>
<script src="/js/libs/dncalendar.min.js"></script>
<script src="/js/libs/canvasjs.min.js"></script>



<script>


    var user_id = '{{Auth::user()->id}}';

    function respond() {
        $('#msg_re_form').slideDown(300);

    }

    $('#members_list').select2({
        'placeholder':'choose members'
    });
    $('#status').select2({
        'placeholder':'choose status'
    });

    $('#search').focusin(function(){
        $('#advanced_search').slideDown(400);
    }).focusout(function(){
        $('#advanced_search').slideUp(300);
    });


        $('#search').keydown(function () {
            if ($(this).val().length == 1) {
                $('#result').hide(100).slideUp();
                $('#result').html('');
            }
        });



        $('#search').keyup(function(){
            if ($(this).val().length != 0 ) {
                var text = $(this).val();
                $('#result').html('');

                jQuery.ajax({
                    type: 'GET',
                    url: '/projects/search/'+ user_id +'/'+ text,
                    success: function(data) {
                        console.log(data);

//                        var result =  responseText.split('$');
//                        console.log(result);
                       $('#result').slideDown(50);

                        if ( data.length >=  2 ){
                            for (var i = 0 ; i < data.length ; i++ ){

                                $('#result').prepend("<a href='/projects/" + data[i].id + "'><h4  id='searched'  >" + data[i].libelle.substr(0,20)  + "...</h4></a>");
                            }
                        } else if (data.length == 1) {
                            $('#result').prepend("<a href='/projects/" +data[0].id+ "'><h4 id='searched'>" + data[0].libelle.substr(0,20) + "...</h4></a>");

                        } else if (data.length == 0) {
                            $('#result').prepend("<h4 id='searched'>Nothing found !!</h4>");
                        }
//
                    }
                });

            }
        });



    $('.message_clicked').click(function(){


        var message_id = $(this).find('i').text();


        jQuery.ajax({
            type: 'GET',
            url: '/message/show/'+message_id+'/',
            success: function(data) {
                console.log(data);
                bootbox.dialog({
                    title: 'Message Details',
                    message: '<div class="panel ">' +
                         ' <div class="list-group-item list-group-item-success"><b>Subject</b> : '+
                                    data.subject +
                            '</div>'+
                            ' <div class="list-group-item list-group-item-default panel-body">'+
                                    '<p><b>Message :</b> ' + data.content + '</p>'+
                                    '<small class="pull-right padding"><b>Sent at</b> :'+ data.created_at +'</small>'+
                                '</div>'+
                    ' <div class="">'+
                        '<a onclick="respond();"  class="btn btn-success btn-block " >Respond</a>'+
                    '</div>'+


                                '<div class="list-group-item list-group-item-default panel-footer" id="msg_re_form" style="display:none;">' +
                                 '<form action="/messages/respond/' + data.from +'" class="form-horizontal" method="POST" > ' +
                                    '<div class="form-group"> ' +
                                    '<input type="hidden" name="_token" value="{{csrf_token()}}"' +
                                    '</div> ' +


                                            '<div class="form-group">'+
                    '<input style="width:80%;margin:auto;"  name="subject" type="text" placeholder="Subject" value="' + data.subject +'" class="list-group-item  form-control "> ' +
                                                '</div>'+
                                                '<div class="form-group">'+
                    '<textarea style="width:80%;margin:auto;"  name="content"  placeholder="Message" class="list-group-item  form-control"></textarea> ' +
                                                '</div>'+
                                                '<div class="form-group">'+
                    '<input style="width:80%;margin:auto;" type="submit"  value="Send" class="list-group-item form-control btn btn-success btn-block">'+
                                                '</div>' +
                    '</form>'+
                    '</div>'+


                                '</div>'




                });
            }
        });


    });









</script>
@yield('script')
</body>
</html>
