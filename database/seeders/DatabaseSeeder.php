<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $address = (new Address())->create([
            'street' => 'test',
            'city' => 'test',
            'province' => 'test',
            'postal_code' => 'test',
        ]);

        (new User())->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'mobile' => '0777123123',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'is_admin' => 1,
            'address_id' => $address->id,
        ]);

        (new Role())->create([
            'name' => 'Admin'
        ]);

        (new Role())->create([
            'name' => 'Moderator'
        ]);

        (new Role())->create([
            'name' => 'Site User'
        ]);


//         \App\Models\User::factory(50)->create();
    }
}
