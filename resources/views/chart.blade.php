@extends('layouts.master')
@section('title') Bikeshop | รายงาน  @endsection

@section("content")
    <div class="container">
        <h1> รายงาน </h1>
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('product') }}"> หน้าแรก </a></li>
            <li class="active"> รายงาน </li>
        </ul>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <strong> มูลค่าสินค้า </strong>
            </div>
        </div>
        <div class="panel-body">
            <canvas id="myBarChart" height="100">  </canvas>
            <canvas id="myPieChart" height="100">  </canvas>
        </div>
    </div>
    <script type="text/javascript">
        var ctx = document.getElementById("myBarChart").getContext('2d');
        var myChart = new Chart(ctx,{
            type: 'bar',
            data: {
                labels: ["สินค้า 1", "สินค้า 2", "สินค้า 3", "สินค้า 4", "สินค้า 5", "สินค้า 6"],
                datasets: [{
                    label: '# of Votes',
                    data: [12 ,19, 3, 5, 2, 3],
                    backgroundColor:
                    [
                        'rgba(255,99,132,0.2)',
                        'rgba(54,162,235,0.2)',
                        'rgba(255,206,86,0.2)',
                        'rgba(75,192,192,0.2)',
                        'rgba(153,102,255,0.2)',
                        'rgba(255,159,64,0.2)'
                    ],
                    borderColor:[
                        'rgba(255,99,132,1)',
                        'rgba(54,162,235,1)',
                        'rgba(255,206,86,1)',
                        'rgba(75,192,192,1)',
                        'rgba(153,102,255,1)',
                        'rgba(255,159,64,1)'
                    ]
                }]
            },
            options: { scales: { yAxes: [{ ticks: { beginAtZero:true } }] }}
        });
        var ctx = document.getElementById("myPieChart").getContext('2d');
        var myPieChart = new Chart(ctx,{
            type: 'pie',
            data: {
                datasets: [{
                    data: [10 ,20, 30],
                    backgroundColor:
                    [
                        'rgba(255,99,132,0.2)',
                        'rgba(54,162,235,0.2)',
                        'rgba(255,206,86,0.2)'
                    ],
                    borderColor:[
                        'rgba(255,99,132,1)',
                        'rgba(54,162,235,1)',
                        'rgba(255,206,86,1)'
                    ]
                }],
                labels: ["สินค้า 1", "สินค้า 2", "สินค้า 3"]
            },
        });
    </script>
@endsection



