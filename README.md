# Delivery Service

## Description

This is a Laravel project for integrating an online store with courier services. The primary goal of the project is to enable the sending of package data to courier services (such as Nova Poshta) with the possibility of easy extension and scaling to support other courier services in the future.

## Key Features

1. **Package Data Transmission to Courier Services**: The project allows sending order data to courier services via API, such as Nova Poshta.
2. **Scalability and Extensibility**: The implemented architecture allows for easy addition of new courier services by creating new classes that implement the `DeliveryServiceInterface`.
3. **Logging and Retry**: All requests and responses are logged for further analysis, and there is also the ability to set up retries in case of unsuccessful deliveries.
4. **Monitoring and Alerts**: There is an option to configure monitoring with automatic administrator notifications in case of delivery issues.

## Project Structure

### Controllers

- **DeliveryController**: The main controller responsible for receiving client requests and sending data to the courier service.

### Services

- **DeliveryServiceInterface**: An interface that defines the `send(array $data): bool` method for sending data.
- **NovaPoshtaService**: An implementation of the interface for working with the Nova Poshta API.
- **DeliveryServiceFactory**: A factory for creating instances of delivery services based on the selected courier service.

### Requests

- **SendPackageRequest**: A request class that defines validation rules for client requests.

## Configuration

API URL settings for different courier services are extracted to the configuration file `config/couriers.php`, allowing easy configuration changes or the addition of new services without the need to modify the code.

Example `.env` configuration:

```env
NOVA_POSHTA_API_URL=https://novaposhta.test/api
UKR_POSHTA_API_URL=https://ukrposhta.test/api
JUSTIN_API_URL=https://justin.test/api
```

### Future Extensions
The architecture is designed to easily support the addition of new courier services. To add a new courier service, simply create a new class that implements the `DeliveryServiceInterface`, update the configuration file with the new service's API URL, and register the service in the `DeliveryServiceFactory`.
If the number of courier services increases to 15 or more, the configuration and service registration can be managed centrally using a configuration file, ensuring that the codebase remains clean and maintainable.

### Handling Delivery Issues
If the customer is experiencing problems when the courier service does not receive data, the project can include detailed logging of each request and response. Additionally, we can implement a retry mechanism to automatically resend data in the event of an error. This ensures that all delivery attempts are tracked and that data transfers are successful whenever possible.

### Scalability for Multiple Courier Services
The project architecture is designed to support a large number of courier services (15 or more) by using a centralized configuration file for managing service-specific API URLs. Each courier service is represented by a class that implements the `DeliveryServiceInterface`. The `DeliveryServiceFactory` dynamically creates instances based on the service specified in the request, ensuring that the system can scale efficiently without code duplication or unnecessary complexity.
