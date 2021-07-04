<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        $tenant->users()->create([
            'name' => 'Victor',
            'email' => 'victor@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $tenant->users()->create([
            'name' => 'Eduardo',
            'email' => 'eduardo@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $tenant->users()->create([
            'name' => 'Thiago',
            'email' => 'thiago@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
