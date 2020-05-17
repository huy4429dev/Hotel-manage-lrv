<?php

use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store = [
            ["ten_mat_hang" => "cocacola","so_luong" => 10, "don_gia" => 20000, "mo_ta" => "ngon"],
        ];

        foreach ($store as $values) {
                DB::table('cua_hang')->insert(
                    $values
                );
        }
    }
}
