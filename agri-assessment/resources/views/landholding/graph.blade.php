<!DOCTYPE html>
<html>
<head>
    <title>Landholding Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Landholding Area by Region</h2>
    <canvas id="landholdingChart" width="600" height="400"></canvas>

    <script>
        const ctx = document.getElementById('landholdingChart').getContext('2d');
        const landholdingChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($regionNames),
                datasets: [{
                    label: 'Total Area (Acres)',
                    data: @json($totalAreas),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Area (Acres)'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
