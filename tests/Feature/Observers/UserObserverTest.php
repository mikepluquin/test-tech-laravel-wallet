<?php

declare(strict_types=1);

use App\Models\User;

test('that initialize empty wallet on user created event', function () {
    $user = User::factory()->create();

    expect($user->wallet->balance)->toEqual(0);
});
