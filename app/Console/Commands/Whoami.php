<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Whoami extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:whoami';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show infos of current user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
