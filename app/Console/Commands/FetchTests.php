<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Test;
use App\Models\Subject;

class FetchTests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:tests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch driver tests from LIS';

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
		//@TODO: Fetch tests 
        return 0;
    }
	
}