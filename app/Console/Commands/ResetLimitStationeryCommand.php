<?php

namespace App\Console\Commands;

use App\Models\LimitStationery;
use Illuminate\Console\Command;

class ResetLimitStationeryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'limit:reset';

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
     * @return int
     */
    public function handle()
    {
        LimitStationery::query()->update([
            'qty_used' => 0,
            'quarter_year' => quarter_of_year(),
            'year' => now()->year
        ]);
        return Command::SUCCESS;
    }
}
