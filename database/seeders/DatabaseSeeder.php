<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
            CartSeeder::class,
            ImageSeeder::class,
            CommentSeeder::class,
            OrderSeeder::class,
            OrderProductSeeder::class,
        ]);
    }
}
