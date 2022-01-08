<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Assignment 1: Form picker
 */
class FormPicker extends Command
{
    /**
     * @inheritDoc
     */
    protected $signature = 'command:form-picker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Shows the numbers 1 to 100. For multiples of 3, show 'Fizz' and show 'Buzz' for multiples of 5. For both FizzBuzz";

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info($this->getDescription());
        for ($i = 1; $i <= 100; $i++) {
            $output = ' ';
            if ($i % 3 === 0) {
                $output .= 'Fizz';
            }

            if ($i % 5 === 0) {
                $output .= 'Buzz';
            }
            $this->info($i . $output);
        }

        $this->info('cron:form-picker executed successfully');
    }
}
