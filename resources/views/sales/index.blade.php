<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Penjualan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
            padding-bottom: 20px;
            font-family: 'Inter', sans-serif;
        }
        .card-total {
            font-size: 1.5rem;
            font-weight: bold;
        }
        table tbody tr:hover {
            background-color: #f0f8ff;
        }
        .table-total {
            font-weight: bold;
            background-color: #e9ecef;
        }
        .table-responsive {
            max-height: 300px; /* Batasi tinggi tabel */
            overflow-y: auto;
        }
        .chart-container {
            max-height: 300px; /* Batasi tinggi chart */
        }
    </style>
</head>
<body>
<div class="container">

    <h1 class="mb-4 text-center">Dashboard Penjualan</h1>

    <!-- Filter Tanggal -->
    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-3">
            <input type="date" name="start_date" class="form-control" value="{{ $startDate }}" placeholder="Tanggal Mulai">
        </div>
        <div class="col-md-3">
            <input type="date" name="end_date" class="form-control" value="{{ $endDate }}" placeholder="Tanggal Akhir">
        </div>
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary me-2">Filter</button>
            <a href="{{ url('/') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <!-- Kartu Total Penjualan -->
    <div class="card mb-3 shadow-sm">
        <div class="card-body text-center">
            <span class="card-total">Total Penjualan: Rp {{ number_format($totalSales, 0, ',', '.') }}</span>
        </div>
    </div>

    <!-- Tabel Penjualan -->
    <div class="table-responsive mb-4">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Tanggal Penjualan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sale->product_name }}</td>
                    <td>{{ $sale->sale_date }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>Rp {{ number_format($sale->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($sale->quantity * $sale->price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                @if($sales->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data penjualan</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Grafik Tren Penjualan -->
<div class="card chart-container shadow-sm" style="height: 300px;">
    <div class="card-body p-2 h-100">
        <h5 class="card-title mb-2 text-center">Grafik Tren Penjualan</h5>
        <canvas id="salesChart" class="h-100 w-100"></canvas>
    </div>
</div>

<!-- Grafik Penjualan Per Produk -->
<!-- <div class="card mt-4 shadow-sm">
    <div class="card-body">
        <h5 class="card-title mb-3">Grafik Penjualan Per Produk</h5>
        <canvas id="productChart" width="400" height="150"></canvas>
    </div>
</div> -->


<script>
const labels = {!! json_encode($chartData->keys()) !!};
const salesData = {!! json_encode($chartData->values()) !!};
const avg = salesData.length > 0 ? salesData.reduce((a,b) => a+b, 0)/salesData.length : 0;

const ctx = document.getElementById('salesChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Total Penjualan',
                data: salesData,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                tension: 0.3,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 7
            },
            {
                label: 'Rata-rata',
                data: Array(salesData.length).fill(avg),
                borderColor: 'red',
                borderWidth: 2,
                borderDash: [5,5],
                pointRadius: 0,
                fill: false
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { 
            legend: { 
                display: true,
                labels: {
                    font: {
                        size: 16  // <--- ukuran font legend
                    }
                }
            },
            title: {
                display: true,
                text: '',
                font: {
                    size: 18  // <--- ukuran font judul
                }
            },
            tooltip: {
                bodyFont: { size: 14 }, // <--- ukuran tooltip
                titleFont: { size: 14 }
            }
        },
        scales: { 
            x: {
                ticks: {
                    font: {
                        size: 14 // <--- ukuran label sumbu X
                    }
                }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    font: {
                        size: 14 // <--- ukuran label sumbu Y
                    }
                }
            }
        }
    }
});

const productCtx = document.getElementById('productChart').getContext('2d');
const productChart = new Chart(productCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($productChartData->keys()) !!},
        datasets: [{
            label: 'Total Penjualan',
            data: {!! json_encode($productChartData->values()) !!},
            backgroundColor: 'rgba(255, 99, 132, 0.7)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: true }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


</script>


</body>
</html>
