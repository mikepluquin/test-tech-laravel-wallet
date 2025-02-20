<?php

namespace App\Policies;

use App\Models\RecurringTransfer;
use App\Models\User;

class RecurringTransferPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, RecurringTransfer $recurringTransfer)
    {
        return $user->id === $recurringTransfer->source->user_id;
    }
}
