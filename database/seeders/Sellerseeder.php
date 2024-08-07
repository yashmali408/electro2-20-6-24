<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Seller;
class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Seller::insert([
            [
                'seller_name' => 'Supreme Electronics'
            ],
            [
                'seller_name' => 'Ezig'
            ],
            [
                'seller_name' => 'SVPeripherals'
            ],
            [
                'seller_name' => 'Seller4'
            ],
        ]);
    }
}