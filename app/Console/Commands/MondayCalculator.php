<?php

namespace App\Console\Commands;

use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use Illuminate\Console\Command;

/**
 * Assignment 3: Maandagen in een periode
 */
class MondayCalculator extends Command
{
    /**
     * How to use: Fill in the date for startDate and endDate. Format should be compatible with DateTime object
     *
     * @var string
     */
    protected $signature = 'command:monday-calculator {--startDate=01-01-2021} {--endDate=25-1-2021}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get dates of mondays in a full week between date ranges';

    /**
     * @throws Exception
     */
    public function handle(): array
    {
        $this->info($this->getDescription());

        $startDate = new DateTime($this->option('startDate'));
        $startDate->modify('next monday');
        $endDate  = new DateTime($this->option('endDate'));
        $interval = new DateInterval('P7D');
        $period   = new DatePeriod($startDate, $interval, $endDate);

        $dates = [];
        foreach ($period as $day) {
            if ($endDate->diff($day)->days >= 7) {
                $dates[] = $day->format('d-m-Y');
            }
        }

        $this->info('Dates for the following mondays: ' . implode(', ', $dates));

        return $dates;
    }
}
