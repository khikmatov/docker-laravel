<?php

namespace App\Pipes;

use App\Containers\ImportCustomersContainer;
use App\Repositories\CustomerRepositoryInterface;
use Closure;

class DeleteAllCustomersPipe
{
    public CustomerRepositoryInterface $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    public function handle(ImportCustomersContainer $container, Closure $next) {
        $this->customerRepository->clear();

        return $next($container);
    }
}
