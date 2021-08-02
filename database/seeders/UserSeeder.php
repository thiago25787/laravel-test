<?php

namespace Database\Seeders;

use App\Enums\ProfileEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function() {
            $exists = User::where("email", "admin@test.com")->exists();
            if (!$exists) {
                User::create([
                    'name' => "Admin",
                    'email' => "admin@test.com",
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'profile' => ProfileEnum::ADMIN,
                ]);
                User::factory(10)->create();
            }
            $exists = User::where("email", "user@test.com")->exists();
            if (!$exists) {
                User::create([
                    'name' => "User",
                    'email' => "user@test.com",
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'profile' => ProfileEnum::CUSTOMER,
                ]);
                User::factory(10)->admin()->create();
            }
        });
    }
}
