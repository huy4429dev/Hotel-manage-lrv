<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   
        $customers = [
            ["ho_ten" => "Nguyen Van A","so_dien_thoai" => "09432432", "so_cmnd" => "43243243", "so_lan_dat_phong" => 2],
            ["ho_ten" => "Nguyen Van B","so_dien_thoai" => "09432431", "so_cmnd" => "43243241", "so_lan_dat_phong" => 1],
        ];

        foreach ($customers as $values) {
                DB::table('khach_hang')->insert(
                    $values
                );
        }
    }
}
