<?php

namespace App\Tenant;

use App\Models\Tenant;

class ManagerTenant
{
    /**
     * Retorna um id tenant do usuario autenticado
     */
    public function getTenantIdentify()
    {
        return auth()->check() ? auth()->user()->tenant_id : '';
    }

    /**
     * Retorna um objeto tenant do usuario autenticado
     */
    public function getTenant()
    {
        return auth()->check() ? auth()->user()->tenant : '';
    }

    /**
     * Retorna verdadeiro se o email do usuário estiver nas configurações de administrador
     */
    public function isAdmin(): bool
    {
        return in_array(auth()->user()->email, config('tenant.admins'));
    }
}