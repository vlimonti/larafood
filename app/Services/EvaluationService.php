<?php

namespace App\Services;

use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;

class EvaluationService
{
    protected $evaluationRepository;
    protected $orderRepository;

    public function __construct(
        EvaluationRepositoryInterface $evaluationRepository,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->evaluationRepository = $evaluationRepository;
        $this->orderRepository = $orderRepository;
    }

    public function createNewEvaluation(string $identify, array $evaluation)
    {   
        $order = $this->orderRepository->getOrderByIdentify($identify);
        $clientId = $this->getClientId();

        return $this->evaluationRepository->newEvaluationOrder($order->id, $clientId, $evaluation);
    }

    private function getClientId()
    {
        $client = auth()->user()->id;
   
        return $client;
    }
}