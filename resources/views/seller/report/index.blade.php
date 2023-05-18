@extends('layouts.food')

@section('title')
    <title>پنل فروشنده | گزارشات</title>
@endsection

@section('content')
    <div class="container d-flex flex-column justify-content-center w-100" style="width:100%;max-width:600px">
        <form action="{{ route('seller.reports.index', ['restaurant' => $restaurant]) }}">
            <div class="d-flex gap-2">
                <select class="form-control" name="search" id="search">
                    <option value="week">هفته گذشته</option>
                    <option value="month">ماه گذشته</option>
                    <option value="year">سال گذشته</option>
                </select>
                <button class="btn btn-outline-secondary" type="submit">جستجو</button>
            </div>
        </form>
        <canvas id="myChart"></canvas>
    </div>

    <script>
    var xValues = ['تعداد کل سفارشات', 'درآمد کل'];
    var yValues = [{{ $total_count }}, {{ $total_price }}];
    var barColors = ["red", "green"];

    new Chart("myChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        legend: {display: false},
        scales: {
            yAxes: [{
                ticks: {
                beginAtZero: true
                }
            }]},
        title: {
        display: true,
        text: "نمودار فروش رستوران"
        }
    }
    });
    </script>
@endsection