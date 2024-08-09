<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 data
        for ($i = 0; $i < 10; $i++) {
            \App\Models\Enter::create([
                'name' => 'Enter ' . $i,
                'balance' => rand(1000, 10000),
                'total' => rand(1000, 10000),
                'date' => now(),
            ]);
        }
    }
}
