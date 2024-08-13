<?php

namespace App\Services\Delivery;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NovaPoshtaService implements DeliveryServiceInterface
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('couriers.nova_poshta.base_url');
    }

    /**
     * Sends a request to the Nova Poshta API.
     *
     * @param array $data The data to send in the request.
     *
     * @return bool Returns true if the request was successful, false otherwise.
     */
    public function send(array $data): bool
    {
        // Log request
        Log::info('Sending request to Nova Poshta API', ['request_data' => $data]);

        $response = Http::post("{$this->baseUrl}/delivery", $data);

        // Log response
        if ($response->successful()) {
            Log::info('Successful response from Nova Poshta API', ['response' => $response->body()]);
            return true;
        } else {
            Log::error('Failed response from Nova Poshta API', ['response' => $response->body()]);
            return false;
        }
    }
}

