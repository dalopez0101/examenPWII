<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    
    public function run(): void
        {
            \App\Models\User::updateOrCreate(
                ['email' => 'admin@agrovalle.hn'],
                [
                    'name' => 'Administrador',
                    'password' => \Illuminate\Support\Facades\Hash::make('Admin12345'),
                    'email_verified_at' => now(),
                ]
            );
        }

}
