<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringTransfer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'source_id',
        'target_id',
        'amount',
        'reason',
        'frequency_days',
        'start_date',
        'end_date',
    ];


    /**
     * @return BelongsTo<Wallet>
     */
    public function source(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'source_id');
    }

    /**
     * @return BelongsTo<Wallet>
     */
    public function target(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'target_id');
    }
}