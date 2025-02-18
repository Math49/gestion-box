<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\Tenant;
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
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'a@a.a',
            'password' => '123456789',
            'structure' => 'personnel',
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'b@b.b',
            'password' => '123456789',
            'structure' => 'personnel',
        ]);

        Box::create([
            'name' => 'Box 1',
            'address' => 'Address 1',
            'description' => 'Description 1',
            'price' => 1000,
            'id_owner' => 1,
        ]);
        Tenant::create([
            'name' => 'Tenant 1',
            'firstname' => 'First Tenant',
            'email' => 't@t.t',
            'phone' => '123456789',
            'address' => 'Address 1',
            'data_owner_id' => 1,
        ]);
    }
}
