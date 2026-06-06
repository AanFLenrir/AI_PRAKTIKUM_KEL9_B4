@extends('layouts.app-breeze')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">📊 Grafik & Statistik</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-3 text-center">Distribusi Status Gizi</h3>
                    <canvas id="pieChart"></canvas>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-3 text-center">Tren Jumlah Balita Baru</h3>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
            <div class="mt-6 text-center text-sm text-gray-500">
                Total balita terdata: <strong>{{ $totalBalita }}</strong>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: @json($pieLabels),
                datasets: [{
                    data: @json($pieData),
                    backgroundColor: ['#e74c3c', '#f39c12', '#2ecc71', '#3498db', '#9b59b6']
                }]
            },
            options: { responsive: true, maintainAspectRatio: true }
        });

        // Line Chart
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Jumlah Balita Baru',
                    data: @json($counts),
                    borderColor: '#4F46E5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: { responsive: true, maintainAspectRatio: true }
        });
    });
</script>
@endsection