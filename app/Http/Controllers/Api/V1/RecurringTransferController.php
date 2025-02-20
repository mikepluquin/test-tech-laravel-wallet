<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreRecurringTransferRequest;
use App\Models\RecurringTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RecurringTransferController
{
    public function store(StoreRecurringTransferRequest $request)
    {
        $sender = auth()->user();
        $source = $sender->wallet;
        $recipient = $request->getRecipient();

        DB::transaction(function () {
            // Save recurring transfer
            $transfer = RecurringTransfer::create([
                'source_id' => $source->id,
                'target_id' => $recipient->wallet->id,
                'amount' => $amount = $request->getAmountInCents(),
                'reason' => $reason = $request->input('reason'),
                'start_date' => $start_date = $request->input('start_date'),
                'end_date' => $request->input('end_date'),
            ]);

            // Execute first transfer if start today
            if ($start_date <= today()) {
                $performWalletTransfer->execute(
                    sender: $sender,
                    recipient: $recipient,
                    amount: $amount,
                    reason: $reason,
                );        
            }
        });

        // TODO: return transfer resource
        return response()->json(null, 200);
    }

    public function index(Request $request)
    {
        return response()->json(auth()->user()->wallet->recurringTransfers);
    }

    public function destroy(RecurringTransfer $recurringTransfer)
    {
        Gate::authorize('delete', $recurringTransfer);
        $recurringTransfer->delete();
        return response()->json(null, 204)
    }
}
