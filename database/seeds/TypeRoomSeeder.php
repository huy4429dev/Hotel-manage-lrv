<?php

use Illuminate\Database\Seeder;

class TypeRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typerooms = [
            ["ten" => "Vip", "gia_phong" => 20000],
            ["ten" => "Normal", "gia_phong" => 10000],

        ];

        foreach ($typerooms as $values) {
            DB::table('loai_phong')->insert(
                $values
            );
        }
    }
}
