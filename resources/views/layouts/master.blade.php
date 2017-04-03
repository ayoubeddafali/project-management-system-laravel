<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">--}}
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">--}}

    <!-- Styles -->
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">--}}
     <link href="/css/libs/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/libs/select2.min.css">
     <link href="/css/style.css" rel="stylesheet">
    {{--<link rel="stylesheet" href="../../../public/bootstrap.min.css">--}}

    <style>
        /*
 * Base structure
 */

        /* Move down content because we have a fixed navbar that is 50px tall */
        body {
            padding-top: 50px;
        }


        /*
         * Global add-ons
         */

        .sub-header {
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        /*
         * Top navigation
         * Hide default border to remove 1px line.
         */
        .navbar-fixed-top {
            border: 0;
        }

        /*
         * Sidebar
         */

        /* Hide for mobile, show later */
        .sidebar {
            display: none;
        }
        @media (min-width: 768px) {
            .sidebar {
                position: fixed;
                top: 51px;
                bottom: 0;
                left: 0;
                z-index: 1000;
                display: block;
                padding: 20px;
                overflow-x: hidden;
                overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
                background-color: #f5f5f5;
                border-right: 1px solid #eee;
            }
        }

        /* Sidebar navigation */
        .nav-sidebar {
            margin-right: -21px; /* 20px padding + 1px border */
            margin-bottom: 20px;
            margin-left: -20px;
        }
        .nav-sidebar > li > a {
            padding-right: 20px;
            padding-left: 20px;
        }
        .nav-sidebar > .active > a,
        .nav-sidebar > .active > a:hover,
        .nav-sidebar > .active > a:focus {
            color: #fff;
            background-color: #428bca;
        }


        /*
         * Main content
         */

        .main {
            padding: 20px;
        }
        @media (min-width: 768px) {
            .main {
                padding-right: 40px;
                padding-left: 40px;
            }
        }
        .main .page-header {
            margin-top: 0;
        }


        /*
         * Placeholder dashboard ideas
         */

        .placeholders {
            margin-bottom: 30px;
            text-align: center;
        }
        .placeholders h4 {
            margin-bottom: 0;
        }
        .placeholder {
            margin-bottom: 20px;
        }
        .placeholder img {
            display: inline-block;
            border-radius: 50%;
        }

    </style>
</head>
<body >
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/projects">Project Management</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/projects">Dashboard</a></li>
                <li><a href="/admin">Settings</a></li>
                @yield('status')

            </ul>
            <div id="search_box">
            <form >
                <input type="text" id="search" autocomplete="off" class="form-control" placeholder="Search project...">
                <div id="result">


                </div>
            </form>

            </div>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
               @if(Auth::user()->role == 'admin')
                <li><a href="/projects/create">New Project</a></li>

                <li><a href="#">Reports</a></li>
                <li><a href="#">Analytics</a></li>
                @endif
                <li><a href="#">Export</a></li>
            </ul>

        </div>
        <div style="margin-top:60px" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            @yield('content')
        </div>

    </div>
</div>


<!-- JavaScripts -->
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>--}}
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <script src="/js/libs/jquery.js"></script>
    <script src="/js/libs/bootstrap.min.js"></script>
    <script src="/js/libs/select2.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#search').keydown(function () {
                if ($(this).val().length == 1) {
                    $('#result').hide(100).slideUp();
                    $('#result').html('');
                }
            });

            $('#search').keyup(function(){
                if ($(this).val().length != 0 ){
                var text = $(this).val();
                    $('#result').html('');


             $.post("{{URL::to('php/test.php')}}" , {
                    text : text
             } ,function(responseText,statusText,xhr){
                 $('#result').slideDown(100);
              var result =  responseText.split('$');
                 console.log(result);
                 if ( result.length >=  2 ){
                     for (var i = 0 ; i < result.length ; i++ ){

                         $('#result').prepend("<a href='/projects/" + result[i].split("/")[1]+ "'><h4  id='searched'  >" + result[i].split("/")[0] + "</h4></a>");
                     }
                 } else {
                     $('#result').prepend("<a href='/projects/" +result[0].split("/")[1]+ "'><h4 id='searched'>" + result[0].split("/")[0] + "</h4></a>");

                 }




             } );
                }

            } );

        } );



        $('#members_list').select2({
            'placeholder':'choose members'
        });
         $('#status').select2({
                    'placeholder':'choose status'
                });



    </script>     {{--Search box script--}}


@yield('script')
</body>
</html>
