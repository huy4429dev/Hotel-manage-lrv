<?php

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            ["ma_phong" => "ui9910", "trang_thai" => "Empty", "loai_phong_id" => 1],
            ["ma_phong" => "ui9009", "trang_thai" => "Full", "loai_phong_id" => 2],

        ];

        foreach ($rooms as $values) {
            DB::table('phong')->insert(
                $values
            );
        }
    }
}
