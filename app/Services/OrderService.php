<?php

namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class OrderService
{
    protected $orderRepository;
    protected $tenantRepository;
    protected $tableRepository;
    protected $productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
        $this->productRepository = $productRepository;
    }

    public function orderByClient()
    {
        $idClient = $this->getClientIdByOrder();

        $orders = $this->orderRepository->getOrdersByClientId($idClient);

        return $orders;
    }

    public function createNewOrder(array $order)
    {
        $productsOrder = $this->getProductsByOrder($order['products']);
        $identify = $this->getIdentifyOrder();
        $total = $this->getTotalOrder($productsOrder);
        $status = 'open';
        $tenantId = $this->getTentantIdByOrder($order['token_company']);
        $comment = isset($order['comment']) ? $order['comment'] : '';
        $clientId = $this->getClientIdByOrder();
        $tableId = $this->getTableIdByOrder($order['table'] ?? '');

        $order = $this->orderRepository->createNewOrder(
            $identify, 
            $total, 
            $status, 
            $tenantId,
            $comment,
            $clientId, 
            $tableId
        );

        $this->orderRepository->registerProductsOrder($order->id, $productsOrder);

        return $order;
    }

    private function getIdentifyOrder(int $qtyCaracteres = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
        $bigLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));

        $characters = $smallLetters.$numbers.$bigLetters;
        $identify = substr(str_shuffle($characters), 0, $qtyCaracteres);
        
        if ($this->orderRepository->getOrderByIdentify($identify)) {
            $identify = $this->getIdentifyOrder($qtyCaracteres + 1);
        }

        return $identify;
    }

    private function getTotalOrder(array $products): float
    {
        $totalOrder = 0;
        foreach ($products as $product) {
            $totalOrder += ($product['qty'] * $product['price']);
        }

        return (float) $totalOrder;
    }

    private function getTentantIdByOrder(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        
        return $tenant->id;
    }

    private function getTableIdByOrder(string $uuid = '')
    {
        if($uuid) {
            $table = $this->tableRepository->getTableByUuid($uuid);

            return $table->id;
        }
        
        return '';
    }

    private function getClientIdByOrder()
    {
        $client = auth()->check() ? auth()->user()->id : '';
   
        return $client;
    }

    private function getProductsByOrder(array $productsOrder): array
    {
        $products = [];
        foreach($productsOrder as $productOrder) {
            $product = $this->productRepository->getProductByUuid($productOrder['identify']);
            
            array_push($products, [
                'id' => $product->id,
                'qty' => $productOrder['qty'],
                'price' => $product->price,
            ]);
        }

        return $products;
    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->orderRepository->getOrderByIdentify($identify);
    }
}