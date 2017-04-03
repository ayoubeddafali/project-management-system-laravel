@extends('layouts.master3')

@section('style')
    <style>
        body{
            color: #DCDCDC;
        }
    </style>
    @endsection
@section('content')


        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                500 Error Page
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">500 error</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="error-page">
                <h2 class="headline text-red">500</h2>

                <div class="error-content">
                    <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>

                    <p>
                        You don't have permission to access this page.
                        Meanwhile, you may <a href="/admin/dashboard">return to dashboard <i class="fa fa-home"></i></a>
                        <br><a href="">Go back <i class="fa fa-reply"></i></a>
                    </p>

                    
                </div>
            </div>
            <!-- /.error-page -->

        </section>
        <!-- /.content -->


    @stop