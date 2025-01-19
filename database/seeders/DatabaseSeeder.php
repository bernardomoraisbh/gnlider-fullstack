<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\User;
use App\Models\Listing;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create();

        // User::factory()->create([
        //     'name' => 'Bernardo',
        //     'email' => 'bernardomalfredo@hotmail.com',
        // ]);


        Listing::factory(20)->create(['by_user_id'=>1]);

        $this->call([
            BrandsTableSeeder::class,
        ]);
    }
}
