<?php

namespace App\Containers;

use Exception;
use Illuminate\Validation\Validator;

class ImportCustomerContainer
{
    private $validator;
    private string $raw;
    private array $data = [];

    public function __construct(string $raw)
    {
        $this->raw = $raw;
    }

    public function getRaw(): string {
        return $this->raw;
    }

    public function getData(): array {
        return $this->data;
    }

    public function setData(array $data): void {
        $this->data = $data;
    }

    public function getValidator(): Validator {
        if (!$this->validator instanceof Validator) {
            throw new Exception('validator not defined');
        }
        return $this->validator;
    }

    public function setValidator(Validator $validator): void {
        $this->validator = $validator;
    }
}
