<?php

namespace App\Console\Commands;

use App\Http\Controllers\CdkController;
use Illuminate\Console\Command;

class makecdk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cdk:make{num=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $num = $this->argument('num');
        $c = new CdkController();
        $c->makecdk($num);
    }
}
