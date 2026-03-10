<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => config('services.nothing.admin_email')],
            [
                'name' => 'Admin Nothing User',
                'password' => Hash::make('password'), // simple for local
            ]
        );

        User::firstOrCreate(
            ['email' => 'demo@nothing.test'],
            [
                'name' => 'Demo Nothing User',
                'password' => Hash::make('password'), // simple for local
            ]
        );
    }
}
