<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // admin

        User::create([
            "name"     => "Admin",
            "phone"    => "88001710528972",
            "email"    => "admin@gmail.com",
            "password" => Hash::make('12345678'),
        ]);

        User::factory(5)->create();
    }
}
