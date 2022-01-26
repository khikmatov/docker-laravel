<?php

namespace App\Pipes;

use App\Containers\ImportCustomerContainer;
use App\Containers\ImportCustomersContainer;
use Closure;
use Illuminate\Support\Facades\Validator;

class AddValidatorPipe
{
    public function handle(ImportCustomersContainer $container, Closure $next) {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|integer|min:18|max:99'
        ];

        $container->getItems()->each(function(ImportCustomerContainer $item) use ($rules) {
            $item->setValidator(Validator::make($item->getData(), $rules));
        });

        return $next($container);
    }
}
