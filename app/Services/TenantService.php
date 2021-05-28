<?php

namespace App\Services;

use App\Models\Plan;


class TenantService
{
    private $plan, $data = [];

    public function make( Plan $plan, array $data )
    {
        $this->plan = $plan;
        $this->data = $data;

        $tenant = $this->storeTenant();
        $user = $this->storeUser($tenant);

        return $user;
    }

    public function storeTenant()
    {
        return $this->plan->tenants()->create([
            'cnpj'  => $this->data['cnpj'], 
            'name'  => $this->data['company'], 
            'email' => $this->data['email'],

            'subscription' => now(),
            'expires_at' => now()->addDay(7),
        ]);
    }

    public function storeUser($tenant)
    {
        $user = $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => bcrypt($this->data['password']),
        ]);

        return $user;
    }
}