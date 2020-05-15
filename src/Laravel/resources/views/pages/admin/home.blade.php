@extends('layouts.admin')

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<div class="mdl-grid" id="drag">
    <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone mdl-cell--12-col-tablet shadow"
        style="background: white">
        <div class="stat">
            <div class="chart-container">
                <div id="chart1" data-percent="100"></div>
                <div class="value"> {{ count(App\Product::all()) }}</div>
            </div>
            <div class="stat-values">
                Products
            </div>
        </div>
    </div>
    <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone mdl-cell--12-col-tablet shadow"
        style="background: white;">
        <div class="stat">
            <div class="chart-container">
                <div id="chart2" data-percent="100"></div>
                <div class="value"> {{ count(App\Order::all()) }}</div>
            </div>
            <div class="stat-values">
                Orders
            </div>
        </div>
    </div>
    <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone mdl-cell--12-col-tablet shadow"
        style="background: white;">
        <div class="stat">
            <div class="chart-container">
                <div id="chart3" data-percent="100"></div>
                <div class="value"> {{ count(App\Category::all()) }}</div>
            </div>
            <div class="stat-values">
                Categories
            </div>
        </div>
    </div>
</div>
@endsection
