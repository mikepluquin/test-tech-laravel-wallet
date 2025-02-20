<?php

declare(strict_types=1);

use App\Models\User;
use App\Models\Wallet;
use App\Notifications\LowBalanceNotification;
use Illuminate\Support\Facades\Notification;

test('that notification is sent when balance is too low', function () {
    Notification::fake();
    $user = User::factory()->create();
    $user->wallet->update(['balance' => Wallet::LOW_BALANCE_TRESHOLD]);
    $user->wallet->update(['balance' => Wallet::LOW_BALANCE_TRESHOLD - 1]);

    Notification::assertSentTo($user, LowBalanceNotification::class);
});

test('that notification is not sent when balance is already too low', function () {
    Notification::fake();
    $user = User::factory()->create();
    $user->wallet->updateQuietly(['balance' => Wallet::LOW_BALANCE_TRESHOLD - 5]);
    $user->wallet->update(['balance' => Wallet::LOW_BALANCE_TRESHOLD - 1]);

    Notification::assertNotSentTo($user, LowBalanceNotification::class);
});

test('that notification is not sent when balance is sufficient', function () {
    Notification::fake();
    $user = User::factory()->create();
    $user->wallet->update(['balance' => Wallet::LOW_BALANCE_TRESHOLD]);

    Notification::assertNotSentTo($user, LowBalanceNotification::class);
});
