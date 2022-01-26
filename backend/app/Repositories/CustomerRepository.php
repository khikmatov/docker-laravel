<?php

namespace App\Repositories;

use App\DTO\CustomerDTO;
use App\Models\Customer;

final class CustomerRepository implements CustomerRepositoryInterface
{
    public function insert(CustomerDTO $data): void {
        Customer::create($data->toArray());
    }

    public function clear(): void {
        Customer::truncate();
    }
}
