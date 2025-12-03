<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Penjualan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Flatpickr CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --success-color: #4cc9f0;
            --light-bg: #f8f9fa;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
            color: #333;
            line-height: 1.5;
            padding: 10px 5px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .container-fluid {
            padding-left: 10px;
            padding-right: 10px;
            max-width: 1200px;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 12px;
            padding: 20px 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.15);
        }

        .header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header h1 i {
            font-size: 1.3rem;
        }

        /* Filter Section */
        .filter-card {
            background: white;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid #eef2f7;
        }

        .filter-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        .form-control-sm {
            padding: 8px 12px;
            font-size: 0.9rem;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .btn-filter {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 10px 15px;
            font-weight: 600;
            height: 42px;
        }

        .btn-reset {
            background-color: white;
            border: 1px solid #ddd;
            color: #666;
            border-radius: 8px;
            padding: 10px 15px;
            font-weight: 600;
            height: 42px;
        }

        /* Summary Cards */
        .summary-card {
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: none;
            transition: transform 0.2s;
            height: 100%;
        }

        .summary-card:hover {
            transform: translateY(-3px);
        }

        .summary-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .summary-title {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .summary-value {
            font-size: 1.4rem;
            font-weight: 700;
            color: #222;
        }

        .card-total {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        /* Table */
        .table-wrapper {
            background: white;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid #eef2f7;
            overflow: hidden;
        }

        .table-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .table-responsive {
            max-height: 350px;
            overflow-y: auto;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        .table {
            margin: 0;
            font-size: 0.9rem;
        }

        .table thead th {
            background-color: #f8f9fa;
            color: #555;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
            padding: 12px 10px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table tbody td {
            padding: 12px 10px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }

        .table tbody tr:hover {
            background-color: #f8fafd;
        }

        .badge-qty {
            background-color: #e9f7ef;
            color: #28a745;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        /* Charts */
        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid #eef2f7;
            height: 300px;
        }

        .chart-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chart-wrapper {
            position: relative;
            height: calc(100% - 30px);
        }

        /* No Data */
        .no-data {
            text-align: center;
            padding: 40px 20px;
            color: #888;
        }

        .no-data i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #ddd;
        }

        /* Loading Overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 15px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 20px 0;
            color: #888;
            font-size: 0.85rem;
            border-top: 1px solid #eee;
            margin-top: 20px;
        }

        /* Mobile Optimizations */
        @media (max-width: 768px) {
            body {
                padding: 8px 5px;
            }
            
            .container-fluid {
                padding-left: 8px;
                padding-right: 8px;
            }
            
            .header {
                padding: 15px 12px;
                margin-bottom: 15px;
                border-radius: 10px;
            }
            
            .header h1 {
                font-size: 1.3rem;
            }
            
            .filter-card {
                padding: 12px;
                border-radius: 10px;
            }
            
            .filter-label {
                font-size: 0.8rem;
            }
            
            .form-control-sm {
                padding: 7px 10px;
                font-size: 0.85rem;
            }
            
            .btn-filter, .btn-reset {
                padding: 8px 12px;
                height: 38px;
                font-size: 0.85rem;
            }
            
            .summary-card {
                padding: 12px;
                border-radius: 10px;
                margin-bottom: 10px;
            }
            
            .summary-icon {
                width: 40px;
                height: 40px;
                margin-bottom: 10px;
            }
            
            .summary-title {
                font-size: 0.75rem;
            }
            
            .summary-value {
                font-size: 1.2rem;
            }
            
            .card-total {
                font-size: 1.4rem;
            }
            
            .table-wrapper {
                padding: 12px;
                border-radius: 10px;
                margin-bottom: 15px;
            }
            
            .table-title {
                font-size: 1rem;
                margin-bottom: 12px;
            }
            
            .table-responsive {
                max-height: 300px;
                font-size: 0.8rem;
            }
            
            .table thead th {
                padding: 10px 8px;
                font-size: 0.8rem;
            }
            
            .table tbody td {
                padding: 10px 8px;
                font-size: 0.8rem;
            }
            
            /* Sembunyikan beberapa kolom di mobile */
            .table thead th:nth-child(3), /* Tanggal */
            .table tbody td:nth-child(3) {
                display: none;
            }
            
            .badge-qty {
                padding: 3px 6px;
                font-size: 0.75rem;
            }
            
            .chart-container {
                padding: 12px;
                border-radius: 10px;
                height: 250px;
                margin-bottom: 15px;
            }
            
            .chart-title {
                font-size: 1rem;
                margin-bottom: 12px;
            }
        }

        @media (max-width: 576px) {
            /* Untuk HP kecil */
            .header h1 {
                font-size: 1.2rem;
            }
            
            .summary-value {
                font-size: 1.1rem;
            }
            
            .card-total {
                font-size: 1.3rem;
            }
            
            .table-responsive {
                max-height: 250px;
                font-size: 0.75rem;
            }
            
            /* Sembunyikan lebih banyak kolom */
            .table thead th:nth-child(5), /* Harga */
            .table tbody td:nth-child(5) {
                display: none;
            }
            
            .chart-container {
                height: 220px;
            }
            
            .btn-filter, .btn-reset {
                font-size: 0.8rem;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #121212;
                color: #e0e0e0;
            }
            
            .header, .filter-card, .summary-card, 
            .table-wrapper, .chart-container {
                background-color: #1e1e1e;
                color: #e0e0e0;
                border-color: #333;
            }
            
            .table {
                color: #e0e0e0;
            }
            
            .table thead th {
                background-color: #252525;
                color: #ccc;
                border-color: #444;
            }
            
            .table tbody td {
                border-color: #333;
            }
            
            .table tbody tr:hover {
                background-color: #252525;
            }
            
            .form-control-sm {
                background-color: #252525;
                border-color: #444;
                color: #e0e0e0;
            }
            
            .btn-reset {
                background-color: #252525;
                border-color: #444;
                color: #ccc;
            }
        }
    </style>
</head>
<body>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="loading-overlay">
    <div class="loading-spinner"></div>
    <p>Memuat data...</p>
</div>

<div class="container-fluid">

    <!-- Header -->
    <div class="header">
        <h1><i class="fas fa-chart-line"></i> Dashboard Penjualan</h1>
        <p class="mb-0 opacity-75">Monitor performa penjualan Anda</p>
    </div>

    <!-- Filter Section -->
    <div class="filter-card">
        <form method="GET" id="filterForm" class="row g-2 align-items-end">
            <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-0">
                <label class="filter-label text-white"><i class="fas fa-calendar-alt me-1"></i> Dari Tanggal</label>
                <input type="text" id="start_date" name="start_date" class="form-control form-control-sm" 
                       value="{{ $startDate }}" placeholder="dd/mm/yyyy">
            </div>
            <div class="col-12 col-sm-6 col-md-3 mb-2 mb-md-0">
                <label class="filter-label text-white"><i class="fas fa-calendar-day me-1"></i> Sampai Tanggal</label>
                <input type="text" id="end_date" name="end_date" class="form-control form-control-sm" 
                       value="{{ $endDate }}" placeholder="dd/mm/yyyy">
            </div>
            <div class="col-12 col-md-6 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-filter flex-fill">
                    <i class="fas fa-filter me-1"></i> Filter Data
                </button>
                <a href="{{ url('/') }}" class="btn btn-reset flex-fill">
                    <i class="fas fa-redo me-1"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-6 col-md-3 mb-3">
            <div class="summary-card" style="background: linear-gradient(135deg, #e3f2fd, #bbdefb);">
                <div class="summary-icon" style="background-color: #1976d2; color: white;">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="summary-title">Total Penjualan</div>
                <div class="summary-value card-total">Rp {{ number_format($totalSales, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="summary-card" style="background: linear-gradient(135deg, #e8f5e9, #c8e6c9);">
                <div class="summary-icon" style="background-color: #388e3c; color: white;">
                    <i class="fas fa-receipt"></i>
                </div>
                <div class="summary-title">Total Transaksi</div>
                <div class="summary-value">{{ $sales->count() }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="summary-card" style="background: linear-gradient(135deg, #fff3e0, #ffe0b2);">
                <div class="summary-icon" style="background-color: #f57c00; color: white;">
                    <i class="fas fa-box"></i>
                </div>
                <div class="summary-title">Produk Terjual</div>
                <div class="summary-value">{{ $sales->sum('quantity') }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="summary-card" style="background: linear-gradient(135deg, #fce4ec, #f8bbd9);">
                <div class="summary-icon" style="background-color: #c2185b; color: white;">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="summary-title">Rata-rata/Transaksi</div>
                <div class="summary-value">
                    @php
                        $avgPerTransaction = $sales->count() > 0 ? $totalSales / $sales->count() : 0;
                    @endphp
                    Rp {{ number_format($avgPerTransaction, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Penjualan -->
    <div class="table-wrapper">
        <div class="table-title text-white">
            <i class="fas fa-table text-white"></i> Data Penjualan
            <span class="badge bg-primary ms-2">{{ $sales->count() }} transaksi</span>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Nama Produk</th>
                        <th class="d-none d-sm-table-cell">Tanggal</th>
                        <th class="text-center">Qty</th>
                        <th class="d-none d-md-table-cell">Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-truncate" style="max-width: 120px;" title="{{ $sale->product_name }}">
                            {{ $sale->product_name }}
                        </td>
                        <td class="d-none d-sm-table-cell">
                            {{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/y') }}
                        </td>
                        <td class="text-center">
                            <span class="badge-qty">{{ $sale->quantity }}</span>
                        </td>
                        <td class="d-none d-md-table-cell">
                            Rp {{ number_format($sale->price, 0, ',', '.') }}
                        </td>
                        <td class="fw-bold">
                            Rp {{ number_format($sale->quantity * $sale->price, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="no-data">
                                <i class="fas fa-database"></i>
                                <p class="mt-2">Tidak ada data penjualan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($sales->count() > 0)
        <div class="mt-3 text-end small text-muted">
            Menampilkan {{ $sales->count() }} transaksi
        </div>
        @endif
    </div>

    <!-- Grafik Tren Penjualan -->
    <div class="row">
        <div class="col-12">
            <div class="chart-container">
                <div class="chart-title text-white">
                    <i class="fas fa-chart-line text-white"></i> Grafik Tren Penjualan
                </div>
                <div class="chart-wrapper">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Grafik Penjualan Per Produk (Opsional) -->
        @if(isset($productChartData) && $productChartData->count() > 0)
        <div class="col-12 col-lg-6">
            <div class="chart-container">
                <div class="chart-title text-white">
                    <i class="fas fa-chart-pie text-white"></i> Penjualan per Produk
                </div>
                <div class="chart-wrapper">
                    <canvas id="productChart"></canvas>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <div class="footer">
        <p class="text-white">Created with <i class="bi bi-heart-fill text-danger"></i> by <a href="https://www.instagram.com/zasapt/" class="text-white fw-bold text-decoration-none">Reza Saputra</a></p>
        <p class="mb-1 text-white"> &copy; {{ date('Y') }}</p>
    </div>

</div>

<script>
    // Inisialisasi Flatpickr untuk input tanggal
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#start_date", {
            dateFormat: "d/m/Y",
            defaultDate: "{{ $startDate }}",
            locale: "id"
        });
        
        flatpickr("#end_date", {
            dateFormat: "d/m/Y",
            defaultDate: "{{ $endDate }}",
            locale: "id"
        });
    });

    // Data untuk chart dari PHP (sesuai kode asli Anda)
    const labels = {!! json_encode($chartData->keys()) !!};
    const salesData = {!! json_encode($chartData->values()) !!};
    
    // Hitung rata-rata
    const avg = salesData.length > 0 ? 
        salesData.reduce((a, b) => a + b, 0) / salesData.length : 0;

    // Render grafik utama
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Penjualan',
                    data: salesData,
                    borderColor: '#4361ee',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#4361ee',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                },
                {
                    label: 'Rata-rata',
                    data: Array(salesData.length).fill(avg),
                    borderColor: '#f72585',
                    borderWidth: 2,
                    borderDash: [5, 5],
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
                    position: 'top',
                    labels: {
                        color: '#ffffff',
                        boxWidth: 12,
                        padding: 15,
                        usePointStyle: true,
                        font: {
                            size: window.innerWidth < 768 ? 10 : 12
                        }
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    padding: 12,
                    titleFont: {
                        size: window.innerWidth < 768 ? 10 : 12
                    },
                    bodyFont: {
                        size: window.innerWidth < 768 ? 10 : 12
                    },
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                            return label;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        maxRotation: 0,
                        color: '#ffffff',
                        font: {
                            size: window.innerWidth < 768 ? 9 : 11
                        },
                        callback: function(value, index) {
                            // Format tanggal pendek untuk mobile
                            if (window.innerWidth < 768) {
                                const dateStr = this.getLabelForValue(index);
                                const date = new Date(dateStr);
                                return date.getDate() + '/' + (date.getMonth() + 1);
                            }
                            return this.getLabelForValue(index);
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        color: '#ffffff',
                        font: {
                            size: window.innerWidth < 768 ? 9 : 11
                        },
                        callback: function(value) {
                            if (value >= 1000000) return 'Rp' + (value/1000000).toFixed(1) + 'Jt';
                            if (value >= 1000) return 'Rp' + (value/1000).toFixed(0) + 'Rb';
                            return 'Rp' + value;
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });

    // Grafik produk (jika ada)
    @if(isset($productChartData) && $productChartData->count() > 0)
    const productLabels = {!! json_encode($productChartData->keys()) !!};
    const productData = {!! json_encode($productChartData->values()) !!};
    
    const productCtx = document.getElementById('productChart').getContext('2d');
    const productChart = new Chart(productCtx, {
        type: 'bar',
        data: {
            labels: productLabels,
            datasets: [{
                label: 'Total Penjualan',
                data: productData,
                backgroundColor: [
                    '#4361ee', '#3a0ca3', '#4cc9f0', '#7209b7', 
                    '#f72585', '#480ca8', '#560bad', '#b5179e'
                ],
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#ffffff',
                        font: {
                            size: window.innerWidth < 768 ? 9 : 11
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#ffffff',
                        font: {
                            size: window.innerWidth < 768 ? 9 : 11
                        },
                        callback: function(value) {
                            if (value >= 1000000) return 'Rp' + (value/1000000).toFixed(1) + 'Jt';
                            if (value >= 1000) return 'Rp' + (value/1000).toFixed(0) + 'Rb';
                            return 'Rp' + value;
                        }
                    }
                }
            }
        }
    });
    @endif

    // Fitur loading saat filter
    document.getElementById('filterForm').addEventListener('submit', function(e) {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });

    // Update chart saat resize window
    window.addEventListener('resize', function() {
        salesChart.resize();
        @if(isset($productChartData) && $productChartData->count() > 0)
        productChart.resize();
        @endif
    });
</script>

</body>
</html>