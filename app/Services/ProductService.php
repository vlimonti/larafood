<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class ProductService
{
    protected $tenantRepository, $productRepository;

    public function __construct(
            TenantRepositoryInterface $tenantRepository,
            ProductRepositoryInterface $productRepository
    ){
        $this->tenantRepository   = $tenantRepository;
        $this->productRepository = $productRepository;
    }

    public function getProductsByTenantId(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->productRepository->getProductsByTenantId($tenant->id);
    }
}