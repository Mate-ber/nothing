<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Certificate;
use App\Models\Nft;
use App\Models\Donation;
use Database\Seeders\DemoUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DemoUserSeeder::class);

        \App\Models\Certificate::factory()->count(5)->create();
        \App\Models\Nft::factory()->count(5)->create();
        \App\Models\Donation::factory()->count(5)->create();
        \App\Models\Subscription::factory()->count(3)->create();
    }
}
