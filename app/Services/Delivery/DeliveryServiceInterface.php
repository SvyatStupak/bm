<?php

namespace App\Services\Delivery;

interface DeliveryServiceInterface
{
    public function send(array $data): bool;
}
