@extends('layout.main')

@section('content')



{{-- Begin page content --}}
<div class="container-fluid">

    <!-- Page heading -->
    <h1 class="h3 mb-2 text-gray-800">Charts</h1>

     <!-- Chart Bar -->
 <div class="card shadow mb-4">
    <div class="card-header py3">
        <h6 class="m-0 font-weight-bold text-info">Bar Chart</h6>
    </div>
        <div class="card-body">
            <div class="chart-bar">
                <canvas id="myBarChart"></canvas>
            </div>
            <hr>
            Styling for the bar chart can be found in the <code>/js/demo/chart-bar-demo.js</code>
        </div>
    </div>

    <!-- chart area -->
    <div class="card shadow mb-4">
        <div class="card-header py3">
            <h6 class="m-0 font-weight-bold text-info">Area Chart</h6>
        </div>
        <div class="card-body">
            <div class="chart-area">
                <canvas id="myAreaChart"></canvas>
            </div>
            <hr>
            Styling for the bar chart can be found in the <code>/js/demo/chart-bar-demo.js</code> file.  
        </div>
    </div>
</div>

@endsection
