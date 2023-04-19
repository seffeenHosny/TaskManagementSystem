<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TaskReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tasks Reminder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
