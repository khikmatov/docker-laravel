<?php

namespace App\Repositories;

use App\DTO\CustomerDTO;

interface CustomerRepositoryInterface {
    public function insert(CustomerDTO $data): void;
    public function clear(): void;
}
