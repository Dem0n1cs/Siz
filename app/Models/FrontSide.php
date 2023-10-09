<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FrontSide extends Model
{
    use HasFactory;

    protected $fillable = [
        'gender',
        'growth',
        'clothing_size',
        'shoe_size',
        'glove_size',
        'corrective_glasses',
        'change_profession',
        'scanned_card',
    ];

    protected $casts = [
        'id' => 'integer',
        'gender' => 'string',
        'growth' => 'integer',
        'clothing_size'=>'string',
        'shoe_size'=>'string',
        'corrective_glasses'=>'string',
        'change_profession'=>'date',
    ];

    public function frontSide(): BelongsTo
    {
        return $this->belongsTo(FrontSide::class);
    }
}
