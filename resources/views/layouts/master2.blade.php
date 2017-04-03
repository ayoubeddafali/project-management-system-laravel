<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >--}}
    {{--<link rel="stylesheet" href="../../../public/bootstrap.min.css">--}}
    <link href="/css/libs/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Project Management</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            @yield('status')
        </ul>
        <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search project...">
        </form>
    </div>
</div>
</nav>
<div style="margin-top:60px "  class="col-sm-9  col-md-8  main">
    <h1 class="page-header">Dashboard</h1>
    @yield('content')
</div>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>--}}

    <script src="/js/libs/jquery.js"></script>
    <script src="/js/libs/bootstrap.min.js"></script>
</body>
</html>