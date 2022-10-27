<?php

namespace Database\Seeders;

use App\Models\TransactionProduct;
use Illuminate\Database\Seeder;

class TransactionProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionProduct::insert([
            [
                'transaction_detail_id' => 1,
                'product_name' => 'Mie Ayam',
                'price' => 15000,
                'qty' => 1,
                'subtotal' => 15000,
            ],
            [
                'transaction_detail_id' => 1,
                'product_name' => 'Es Teh',
                'price' => 4000,
                'qty' => 1,
                'subtotal' => 4000,
            ],
            [
                'transaction_detail_id' => 2,
                'product_name' => 'Mie Ayam',
                'price' => 15000,
                'qty' => 1,
                'subtotal' => 15000,
            ],
            [
                'transaction_detail_id' => 2,
                'product_name' => 'Es Teh',
                'price' => 4000,
                'qty' => 1,
                'subtotal' => 4000,
            ],
            [
                'transaction_detail_id' => 3,
                'product_name' => 'Ayam Geprek',
                'price' => 17000,
                'qty' => 1,
                'subtotal' => 17000,
            ],
            [
                'transaction_detail_id' => 3,
                'product_name' => 'Es Jeruk',
                'price' => 5000,
                'qty' => 2,
                'subtotal' => 10000,
            ],
            [
                'transaction_detail_id' => 4,
                'product_name' => 'Mie Ayam',
                'price' => 15000,
                'qty' => 1,
                'subtotal' => 15000,
            ],
            [
                'transaction_detail_id' => 4,
                'product_name' => 'Es Teh',
                'price' => 4000,
                'qty' => 1,
                'subtotal' => 4000,
            ]
        ]);
    }
}
