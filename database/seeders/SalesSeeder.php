<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;

class SalesSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'product_name' => 'Nawsi Gowyeng Awyam',
                'sale_date'    => '2025-01-01',
                'quantity'     => 2,
                'price'        => 30000,
            ],
            [
                'product_name' => 'Ayam Grepek',
                'sale_date'    => '2025-01-02',
                'quantity'     => 1,
                'price'        => 15000,
            ],
            [
                'product_name' => 'Manis Teh Es',
                'sale_date'    => '2025-01-03',
                'quantity'     => 2,
                'price'        => 6000,
            ],
            [
                'product_name' => 'Kopi Susu',
                'sale_date'    => '2025-01-03',
                'quantity'     => 2,
                'price'        => 10000,
            ],
            [
                'product_name' => 'Es Cokelat',
                'sale_date'    => '2025-01-03',
                'quantity'     => 2,
                'price'        => 8000,
            ],
        ];

        foreach ($data as $item) {
            Sale::create($item); // otomatis buat created_at & updated_at
        }
    }
}
