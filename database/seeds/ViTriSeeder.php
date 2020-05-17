<?php

use Illuminate\Database\Seeder;

class ViTriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postions = [
            ["ten" => "Admin"],
            ["ten" => "Giám đốc"],
            ["ten" => "Quản lý"],
        ];

        foreach ($postions as $values) {
            DB::table('vi_tri')->insert(
                $values
            );
        }
    }
}
