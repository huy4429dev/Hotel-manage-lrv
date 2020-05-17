<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
            ["trang_thai" => false, "tong_tien" => 50000, "khach_hang_id" => 1, "user_id" => 1, "phong_id" => 1],
            ["trang_thai" => true, "tong_tien" => 20000, "khach_hang_id" => 2, "user_id" => 2, "phong_id" => 2],

        ];

        foreach ($orders as $values) {
            DB::table('hoa_don')->insert(
                $values
            );
        }
    }
}
