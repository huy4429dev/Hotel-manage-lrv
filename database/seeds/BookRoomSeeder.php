<?php

use Illuminate\Database\Seeder;

class BookRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookrooms = [
            ["ghi_chu"=> "good","khach_hang_id" => 1,"phong_id" => 1],
            ["ghi_chu"=> "good morning","khach_hang_id" => 1,"phong_id" => 2],
            ["ghi_chu"=> "oh my god","khach_hang_id" => 2,"phong_id" => 1],
            ["ghi_chu"=> "wow","khach_hang_id" => 2,"phong_id" => 2],

        ];
  
        foreach ($bookrooms as $values) {
            DB::table('dat_phong')->insert(
                $values
            );
        }
    }
}
