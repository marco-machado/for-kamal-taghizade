<?php

namespace App\Console\Commands;

use App\Models\Item;
use Illuminate\Console\Command;

class PurgeOldItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'item:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge items more than 30 days old';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $itemsPurged = Item::oldRecords()->delete();
        $this->info("Found and purged {$itemsPurged} items");

        return Command::SUCCESS;
    }
}
