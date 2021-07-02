<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class CategoryService
{
    protected $tenantRepository, $categoryRepository;

    public function __construct(
            TenantRepositoryInterface $tenantRepository,
            CategoryRepositoryInterface $categoryRepository
    ){
        $this->tenantRepository   = $tenantRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoriesByUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->categoryRepository->getCategoriesByTenantId($tenant->id);
    }

    public function getCategoryByUuid(string $uuid)
    {
        return $this->categoryRepository->getCategoryByUuid($uuid);
    }
}