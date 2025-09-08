<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
 
        public function run(): void
        {
            $this->call([
                BannerSeeder::class,
            ]);
            $this->call([
                CategorySeeder::class,
                // other seeders...
            ]);
            $this->call([
                VariantSeeder::class,
            ]);
            $this->call([
                BrandSeeder::class,
            ]);

            $this->call([
                ProductSeeder::class,
            ]);

        }
    
}
