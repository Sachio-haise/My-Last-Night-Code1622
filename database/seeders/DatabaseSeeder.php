<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       User::factory(30)->create();

        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            RoleUserSeeder::class
        ]);


    }
}
