<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Wallet;
use App\Notifications\LowBalanceNotification;

class WalletObserver
{
    /**
     * Handle the Wallet "created" event.
     */
    public function created(Wallet $wallet): void
    {
        //
    }

    /**
     * Handle the Wallet "updated" event.
     */
    public function updated(Wallet $wallet): void
    {
        // Notify user if balance became too low
        if ($wallet->getOriginal('balance') >= Wallet::LOW_BALANCE_TRESHOLD && $wallet->balance < Wallet::LOW_BALANCE_TRESHOLD) {
            $wallet->user->notify(new LowBalanceNotification);
        }
    }

    /**
     * Handle the Wallet "deleted" event.
     */
    public function deleted(Wallet $wallet): void
    {
        //
    }

    /**
     * Handle the Wallet "restored" event.
     */
    public function restored(Wallet $wallet): void
    {
        //
    }

    /**
     * Handle the Wallet "force deleted" event.
     */
    public function forceDeleted(Wallet $wallet): void
    {
        //
    }
}
