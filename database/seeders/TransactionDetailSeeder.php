<?php

namespace Database\Seeders;

use App\Models\TransactionDetail;
use Illuminate\Database\Seeder;

class TransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionDetail::insert([
            [
                'transaction_id' => 1,
                'name' => 'Yanuar',
                'expanse' => 14550,
            ],
            [
                'transaction_id' => 1,
                'name' => 'Fatich',
                'expanse' => 14550,
            ],
            [
                'transaction_id' => 1,
                'name' => 'Habib',
                'expanse' => 20950,
            ],
            [
                'transaction_id' => 1,
                'name' => 'Zidan',
                'expanse' => 14550,
            ],
        ]);
    }
}
