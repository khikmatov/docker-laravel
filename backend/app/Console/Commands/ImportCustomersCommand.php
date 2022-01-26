<?php

namespace App\Console\Commands;

use App\Containers\ImportCustomerContainer;
use App\Containers\ImportCustomersContainer;
use App\Pipes\{
    AddValidatorPipe,
    DeleteAllCustomersPipe,
    InsertCustomersPipe,
    PrepareDataPipe,
    ReadFromSourcePipe,
};
use Closure;
use Illuminate\Console\Command;
use Illuminate\Pipeline\Pipeline;

class ImportCustomersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:import {source : Source file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import customers from source';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $container = new ImportCustomersContainer(
            $this->argument('source')
        );

        /** @var Pipeline $pipeline */
        $pipeline = app(Pipeline::class);
        $pipeline
            ->send($container)
            ->through([
                ReadFromSourcePipe::class,
                PrepareDataPipe::class,
                AddValidatorPipe::class,
                DeleteAllCustomersPipe::class,
                InsertCustomersPipe::class,
                [$this, 'write'],
            ])
            ->thenReturn();

        return 0;
    }

    public function write(ImportCustomersContainer $container, Closure $next) {
        $container->getItems()->each(function(ImportCustomerContainer $item) {
            if ($item->getValidator()->fails()) {
                $this->error($item->getRaw());
                $errors = $item->getValidator()->getMessageBag()->getMessages();
                foreach ($errors as $name => $messages) {
                    $this->error(" - $name: {$messages[0]}");
                }
                $this->line('');
            }
        });

        $total = $container->getItems()
            ->filter(function(ImportCustomerContainer $item) {
                return $item->getValidator()->fails();
            })
            ->count();

        $this->error("Total: $total");

        return $next($container);
    }
}
