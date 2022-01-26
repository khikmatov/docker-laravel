<?php

namespace App\Pipes;

use App\Containers\ImportCustomerContainer;
use App\Containers\ImportCustomersContainer;
use Closure;

class PrepareDataPipe
{
    public function handle(ImportCustomersContainer $container, Closure $next) {
        $keys = ['id', 'name', 'email', 'age', 'location'];

        $container->getItems()->each(function (ImportCustomerContainer $item) use ($keys) {
            $parsed = str_getcsv($item->getRaw());
            $item->setData(
                array_combine($keys, $parsed),
            );
        });

        return $next($container);
    }
}
