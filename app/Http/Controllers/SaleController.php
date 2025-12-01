<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter tanggal dari query string
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query penjualan dengan filter tanggal jika ada
        $query = Sale::query();
        if ($startDate) {
            $query->where('sale_date', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('sale_date', '<=', $endDate);
        }

        // Urutkan data berdasarkan nama produk
        $sales = $query->orderBy('product_name')->get();

        // Total penjualan
        $totalSales = $sales->sum(fn($sale) => $sale->quantity * $sale->price);

        // Data chart tren penjualan (per tanggal)
        $chartData = $sales->groupBy('sale_date')
            ->map(fn($rows) => $rows->sum(fn($r) => $r->quantity * $r->price));

        // Data chart penjualan per produk (urut sesuai abjad)
        $productChartData = $sales->groupBy('product_name')
            ->sortKeys() // <- ini memastikan urut abjad
            ->map(fn($rows) => $rows->sum(fn($r) => $r->quantity * $r->price));

        // Kirim semua variabel ke view
        return view('sales.index', compact(
            'sales',
            'totalSales',
            'chartData',
            'productChartData',
            'startDate',
            'endDate'
        ));
    }
}
