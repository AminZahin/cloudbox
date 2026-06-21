<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = Tenant::first();

        User::create([
            'tenant_id' => $tenant->id,
            'name' => 'Amin',
            'email' => 'amin@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}