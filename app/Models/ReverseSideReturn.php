<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReverseSideReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
        'quantity',
        'percentage_wear',
        'cost',
        'signatures',
        'signatures_note',
        'reverse_side_id',
    ];

    public function reverseSideGive(): BelongsTo
    {
      return $this->belongsTo(ReverseSideGive::class);
    }
}
