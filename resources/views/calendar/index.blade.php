@extends('layouts.master3')


@section('style')
    <style>
        .date{
            width: 30%;
            display: inline-block;
            /*display: none;*/
            /*border:1px solid lightgrey;*/
            /*border-radius: 5px;*/
            height: auto;
            margin-right: 5px;
            visibility: hidden;

        }
        .date>span {
            visibility: visible;
        }
        .date .box {
            visibility: visible;
        }

    </style>
    @stop
@section('content')
<div id="dncalendar-container">

</div>

@stop


@section('script')
    <script>

        var all = [];
        for (var i = 0 ; i < projects.length ; i++){
            var dates =  { "date" : "", "note": [""] };
//            console.log(projects[i]);
            dates.date =    projects[i].debut  ;
            dates.note[i] = '<div class="box box-info" style="margin-right: 6px; margin-bottom: 6px;">' +
                    '<div class="box-header">' +
                    '<h3 class="box-title"> '+ projects[i].libelle + '</h3>' +
                    '<div class="box-body">'+
                            '<ul class="list list-group">' +
                            '<li class="list list-group-item">Date fin :' ;


            dates.note[i+1] = projects[i].fin + '</li></ul></div></div></div>';
            all.push(dates);
        }
        console.log(all);

        var my_calendar = $("#dncalendar-container").dnCalendar({
            dataTitles: { defaultDate: 'default', today : 'Today' },
            notes: all,
            showNotes: true,
            dayClick: function(date, view) {
                console.log(view);
            }
        });

        my_calendar.build();
    </script>
@endsection