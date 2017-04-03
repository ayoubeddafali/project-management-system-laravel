@extends('layouts.master3')

@section('content')
<div style="padding: 5%;">
<div class="row">
    <div class="col-lg-6">
        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
    </div>
    <div class="col-lg-6">
        <div id="chart2" style="height: 300px; width: 100%;"></div>
    </div>
</div>
    <div class="row" style="margin-top: 20px">
    <div class="col-lg-12">
        <div id="chartContainer3" style="height: 300px; width: 100%;"></div>
    </div>
    </div>


</div>





@stop
@section('script1')
    <script>
            total = {!! json_encode($total) !!};
            users ={!! json_encode($users) !!};
            datas = [];
            for ( var i = 0 ; i < total.length ; i++){
                datapoints = {x:'' , y:''};
                datapoints.x = new Date(total[i].created_at)  ;
                datapoints.y = total[i].id;
                datas.push(datapoints);

            }


    window.onload = function () {
        var chart1 = new CanvasJS.Chart("chartContainer",
                {
                    theme: "theme2",
                    title: {
                        text: "Projects Of this Year"
                    },
                    animationEnabled: true,
                    axisX: {
                        valueFormatString: "MMM",
                        interval: 1,
                        intervalType: "month"

                    },
                    axisY: {
                        includeZero: false

                    },
                    data: [
                        {
                            type: "line",
                            //lineThickness: 3,
                            dataPoints: datas
                        }


                    ]
                });

        chart1.render();


        var chart2 = new CanvasJS.Chart("chart2",
                {
                    title: {
                        text: "Overview",
                        fontFamily: "arial black"
                    },
                    animationEnabled: true,
                    legend: {
                        verticalAlign: "bottom",
                        horizontalAlign: "center"
                    },
                    theme: "theme1",
                    data: [
                        {
                            type: "pie",
                            indexLabelFontFamily: "Garamond",
                            indexLabelFontSize: 20,
                            indexLabelFontWeight: "bold",
                            startAngle: 0,
                            indexLabelFontColor: "MistyRose",
                            indexLabelLineColor: "darkgrey",
                            indexLabelPlacement: "inside",
                            toolTipContent: "{name}: {y}",
                            showInLegend: true,
                            indexLabel: "#percent%",
                            dataPoints: [
                                {y: projects, name: "projects", legendMarkerType: "triangle"},
                                {y: milestones, name: "Milestones", legendMarkerType: "square"},
                                {y: tasks, name: "Tasks", legendMarkerType: "circle"}
                            ]
                        }
                    ]
                });
        chart2.render();


        datasUsers = [];
        for (var i = 0 ;  i< users.length ; i++){
            usersData = {label :'' ,  y :''};
            usersData.label = users[i].name ;
            usersData.y = parseInt(users[i].count);
            datasUsers.push(usersData);
        }
        var chart3 = new CanvasJS.Chart("chartContainer3",
                {
                    title: {
                        text: "Users Contributions"
                    },
                    animationEnabled: true,
                    axisY: {
                        title: "Count"
                    },
                    legend: {
                        verticalAlign: "bottom",
                        horizontalAlign: "center"
                    },
                    theme: "theme2",
                    data: [

                        {
                            type: "column",
                            showInLegend: true,
                            legendMarkerColor: "grey",
                            legendText: "Users projects",
                            dataPoints: datasUsers
                        }
                    ]
                });

        chart3.render();

    }

    </script>

    @endsection