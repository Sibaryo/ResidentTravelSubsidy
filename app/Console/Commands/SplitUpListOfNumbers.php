<?php
declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Assignment 2: Verdelen van verzamelingen
 */
class SplitUpListOfNumbers extends Command
{
    /**
     * @inheritDoc
     */
    protected $signature = 'command:split-up-list {list*} {--limit=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Split up the list of numbers by maximum allowed elements in the list (limit) put the remaining numbers in another list';

    public function handle(): array
    {
        $this->info($this->getDescription());
        $limit = (int)$this->option('limit');
        $list  = $this->argument('list');

        $newLists = array_chunk($list, $limit);

        $this->info('New list of lists with limit=' . $limit . ' contains ' . count($newLists) . ' new lists');
        foreach ($newLists as $key => $newList) {
            $this->info('List nr' . ++$key . ' array=[' . implode(',', $newList) . ']');
        }

        return array_chunk($list, $limit);
    }
}
