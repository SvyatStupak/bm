<?php

namespace App\Services\Delivery;

use Exception;

class DeliveryServiceFactory
{
    public static function create(string $courier): DeliveryServiceInterface
    {
        // Choice of courier service
        switch ($courier) {
            case 'nova_poshta':
                return new NovaPoshtaService();
            // Сan add other courier services
            default:
                throw new Exception("Unsupported courier service: $courier");
        }
    }
}

