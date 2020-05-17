<?php

use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderDetails = [
            ["mat_hang_id" => 1,"so_luong" => 10, "don_gia" => 20000, "thanh_tien" => 25000, "hoa_don_id" => 1],
        ];

        foreach ($orderDetails as $values) {
                DB::table('chi_tiet_hoa_don')->insert(
                    $values
                );
        }
    }
}
