<?php

namespace App\Containers;

use Illuminate\Support\Collection;

class ImportCustomersContainer
{
    private string $source;
    private Collection $items;

    public function __construct(string $source) {
        $this->source = $source;
        $this->items = collect();
    }

    public function getSource(): string {
        return $this->source;
    }

    public function getItems(): Collection {
        return $this->items;
    }

    public function addItem(ImportCustomerContainer $item): void {
        $this->items->push($item);
    }
}
