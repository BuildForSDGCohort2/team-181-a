<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Age_Regiment;
use App\Plant_dev_regiment;

class RunCheckers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:runcheckers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks animal and plant information compare to fact sheet and alert farmer if need be.';

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
        Age_Regiment::check();
        Plant_dev_regiment::check();
         return;
    }
}
