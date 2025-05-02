@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">🚿 Irrigation Sources Overview</h1>

    <div class="card p-4 shadow-sm">
        <canvas id="irrigationChart" height="100"></canvas>
    </div>

    <a href="{{ route('irrigationsources.index') }}" class="btn btn-primary mt-3">
        <i class="bi bi-arrow-left"></i> Back to Irrigation List
    </a>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('irrigationChart').getContext('2d');
const irrigationChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: @json($labels),
        datasets: [{
            label: 'Irrigation Sources',
            data: @json($totals),
            backgroundColor: [
                '#4CAF50', '#2196F3', '#FFC107', '#FF5722', '#9C27B0', '#00BCD4'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Distribution of Irrigation Sources'
            }
        }
    }
});
</script>
@endsection
