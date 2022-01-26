<?php

namespace App\DTO;

class CustomerDTO {
    private string $name;
    private string $email;
    private int $age;
    private string $location;

    public function __construct(string $name, string $email, int $age, string $location) {
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->location = $location;
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'age' => $this->age,
            'location' => $this->location,
        ];
    }
}
