<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (env('ADMIN_PROD_EMAIL') && env('ADMIN_PROD_PASSWORD')) {
            $admin_email = env('ADMIN_PROD_EMAIL');
            $admin_password = env('ADMIN_PROD_PASSWORD');
            $admin_name = env('ADMIN_PROD_NAME', 'Admin'); // Default name if not set

            Admin::firstOrCreate(
                ['email' => $admin_email],
                [
                    'name' => $admin_name,
                    'password' => Hash::make($admin_password),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        $this->command->info('Usuario administrador inicial creado o ya existe.');
        $this->command->info("Email: {$admin_email}");
        $this->command->info("Contraseña: (usó la definida o de ENV)");
        }
    }
}
