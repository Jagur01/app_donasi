<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesCampaignSeeder extends Seeder
{
    public function run(): void
    {
        DB::table(table: 'categories_campaign')->insert([
            // ['name' => 'Bencana'],
            // ['name' => 'Pendidikan'], 
        ]);
    }
}
