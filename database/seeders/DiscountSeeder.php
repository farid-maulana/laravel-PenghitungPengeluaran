<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discount::insert([
            [
                'transaction_id' => 1,
                'discount' => 0.3,
                'maximum_discount' => 30000,
                'minimum_transaction' => 40000
            ],
        ]);
    }
}
