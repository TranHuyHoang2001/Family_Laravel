<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('category')->truncate();
        $data = [
            [
                'name' => 'Nấu ăn'
            ],[
                'name' => 'Sức khỏe'
            ],[
                'name' => 'Du lịch'
            ],
        ];
        DB::table('category')->insert($data);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
