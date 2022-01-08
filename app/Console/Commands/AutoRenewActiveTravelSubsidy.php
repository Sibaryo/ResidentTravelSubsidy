<?php

namespace App\Console\Commands;

use App\Http\Controllers\TravelSubsidyController;
use DateTime;
use Illuminate\Console\Command;

class AutoRenewActiveTravelSubsidy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:auto-renew-subsidy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private TravelSubsidyController $subsidyController;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->subsidyController = new TravelSubsidyController();
    }

    public function handle(): int
    {
        $subsidies = $this->subsidyController->findRenewableSubsidies();
        $this->info('Found ' . $subsidies->count() . ' results');

        $subsidies->update(['updated_at' => new DateTime()]);

        return 1;
    }
}
