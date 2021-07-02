<?php

namespace App\Services;

use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TableService
{
    protected $tenantRepository, $tableRepository;

    public function __construct(
            TenantRepositoryInterface $tenantRepository,
            TableRepositoryInterface $tableRepository
    ){
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository  = $tableRepository;
    }

    public function getTablesByUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->tableRepository->getTablesByTenantId($tenant->id);
    }

    public function getTableByUuid(string $uuid)
    {
        return $this->tableRepository->getTableByUuid($uuid);
    }
}