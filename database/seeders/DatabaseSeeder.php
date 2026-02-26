<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // siswa
        User::create([
            'name'=> 'Siswa1',
            'email'=> 'siswa1@mail.com',
            'password'=> Hash::make('password'),
            'role' => 'siswa',
        ]);

        User::create([
            'name'=> 'Siswa2',
            'email'=> 'siswa2@mail.com',
            'password'=> Hash::make('password'),
            'role' => 'siswa'
        ]);

        User::create([
            'name'=> 'Siswa3',
            'email'=> 'siswa3@mail.com',
            'password'=> Hash::make('password'),
            'role' => 'siswa'
        ]);
    }
}
