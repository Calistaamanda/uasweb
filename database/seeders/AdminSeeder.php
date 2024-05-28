<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            ['name' => 'Admin1', 'email' => 'admin1@example.com', 'password' => bcrypt('password'), 'role' => 'admin'],
            ['name' => 'Admin2', 'email' => 'admin2@example.com', 'password' => bcrypt('password'), 'role' => 'admin'],
            // tambahkan admin lainnya jika perlu
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }
    }
}
