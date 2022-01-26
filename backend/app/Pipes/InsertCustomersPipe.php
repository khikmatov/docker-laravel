<?php

namespace App\Pipes;

use App\Containers\ImportCustomerContainer;
use App\Containers\ImportCustomersContainer;
use App\DTO\CustomerDTO;
use App\Repositories\CustomerRepositoryInterface;
use Closure;
use Illuminate\Support\Arr;

class InsertCustomersPipe
{
    public CustomerRepositoryInterface $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    public function handle(ImportCustomersContainer $container, Closure $next) {
        $container->getItems()->each(function(ImportCustomerContainer $item) {
            if (!$item->getValidator()->fails()) {
                $location = (string)Arr::get($item->getData(), 'location');
                if ($location === '') {
                    $location = 'Unknown';
                }
                $this->customerRepository->insert(
                    new CustomerDTO(
                        (string)Arr::get($item->getData(), 'name'),
                        (string)Arr::get($item->getData(), 'email'),
                        (int)Arr::get($item->getData(), 'age'),
                        $location,
                    ),
                );
            }
        });

        return $next($container);
    }
}
