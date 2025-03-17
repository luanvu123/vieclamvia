@extends('layouts.app')

@section('content')
<div class="container">
    <div id="chart" style="height: 500px;"></div>

    <div class="mt-4">
        <div class="card">
            <div class="card-body">
                <h4>Tổng Kết Tháng Hiện Tại</h4>
                <p><strong>Tổng Doanh Thu:</strong> {{ number_format($totalRevenue, 0, ',', '.') }} VND</p>
                <p><strong>Tổng Lợi Nhuận:</strong> {{ number_format($totalProfit, 0, ',', '.') }} VND</p>
            </div>
        </div>
    </div>
</div>

<!-- Thêm thư viện ECharts -->
<script src="https://cdn.jsdelivr.net/npm/echarts@latest/dist/echarts.min.js"></script>
<script>
    var chartData = @json($chartData);

    var dates = chartData.map(item => item.date);
    var revenues = chartData.map(item => item.revenue);
    var profits = chartData.map(item => item.profit);

    var chart = echarts.init(document.getElementById('chart'));

    var options = {
        tooltip: { trigger: 'axis' },
        legend: { data: ['Doanh thu', 'Lợi nhuận'] },
        xAxis: { type: 'category', data: dates },
        yAxis: { type: 'value' },
        series: [
            {
                name: 'Doanh thu',
                type: 'bar',
                data: revenues,
                itemStyle: { color: '#4CAF50' }
            },
            {
                name: 'Lợi nhuận',
                type: 'bar',
                data: profits,
                itemStyle: { color: '#FF9800' }
            }
        ]
    };

    chart.setOption(options);
</script>
@endsection
