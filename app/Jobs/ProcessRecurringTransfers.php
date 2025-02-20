<?php

namespace App\Jobs;

use App\Models\RecurringTransfer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessRecurringTransfers implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // RecurringTransfer::where('start_date', '<=', today())
        //     ->where('end_date', '>=', today());
    }
}
