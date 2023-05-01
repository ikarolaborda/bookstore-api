<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Seed the admin user
        User::factory()->create([
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // Seed 10 random books
        Book::factory(10)->create();
    }
}
