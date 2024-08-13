<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendPackageRequest;
use App\Services\Delivery\DeliveryServiceFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class DeliveryController extends Controller
{
    /**
     * Send a package using the specified courier service.
     *
     * @param SendPackageRequest $request The request data containing the package details.
     * @return \Illuminate\Http\JsonResponse The response indicating the success or failure of the package sending.
     */
    public function sendPackage(SendPackageRequest $request)
    {
        try {
            // Choice of courier service
            /**
             * The architecture envisages an increase in courier services to at least 15
             */
            $deliveryService = DeliveryServiceFactory::create($request->courier);

            $data = [
                'customer_name' => $request->customer_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'sender_address' => config('app.sender_address'),
                'delivery_address' => $request->address,
            ];

            // Sending data via the selected delivery service
            /**
             * We can save the data to the database for further analysis,
             * but first we need to create a migration and a model
             */
            if ($deliveryService->send($data)) {
                return response()->json(['message' => 'Package sent successfully'], 200);
            } else {
                return response()->json(['message' => 'Failed to send package'], 500);
            }
        } catch (Exception $e) {
            Log::error('Delivery failed: ' . $e->getMessage());
            return response()->json(['message' => 'Delivery service error'], 500);
        }
    }
}

