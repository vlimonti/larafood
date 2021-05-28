<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj'  => '12345678912345', 
            'name'  => 'SejaTrigo', 
            'url'   => 'sejatrigo', 
            'email' => 'vl.webart@gmail.com'
        ]);
    }
}
