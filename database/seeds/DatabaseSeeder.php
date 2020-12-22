<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::table('users')->insert([
            'username' => 'monsef.admin.1',
            'firstname' => 'monsef',
            'lastname' => 'Admin',
            'fullname' => 'monsef Admin',
            'email' => 'monsef@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$Tz8KW1vWlv6yyyBSFNnZLup0H3om2N24BvAR29sGSeQT5XmX8MbFK', // 123456789
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'parent']);
        Role::create(['name' => 'staff']);
        Role::create(['name' => 'teacher']);
        Role::create(['name' => 'student']);


    }
}
