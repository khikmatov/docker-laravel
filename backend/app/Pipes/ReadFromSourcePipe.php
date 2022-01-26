<?php

namespace App\Pipes;

use App\Containers\ImportCustomerContainer;
use App\Containers\ImportCustomersContainer;
use Closure;

class ReadFromSourcePipe
{
    public function handle(ImportCustomersContainer $container, Closure $next) {
        $items = file($container->getSource());
        foreach($items as $raw) {
            $container->addItem(new ImportCustomerContainer(rtrim($raw)));
        }

        return $next($container);
    }
}
