<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ReverseSideGive extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'ppe_id',
        'date',
        'quantity',
        'percentage_wear',
        'cost',
        'signature',
        'signature_note',
        'sorting',
    ];

    public function reverseSideReturn(): HasOne
    {
        return $this->HasOne(ReverseSideReturn::class);
    }

    public function ppe(): BelongsTo
    {
        return $this->belongsTo(Ppe::class);
    }

    public function personalCard(): BelongsTo
    {
      return $this->belongsTo(PersonalCard::class);
    }
}
