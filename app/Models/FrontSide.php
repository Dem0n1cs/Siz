<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FrontSide extends Model
{
    use HasFactory;

    protected $fillable = [
        'gender',
        'height_id',
        'clothing_size_id',
        'shoe_size',
        'glove_size',
        'corrective_glasses',
        'change_profession',
        'scanned_card',
    ];

    protected $casts = [
        'id' => 'integer',
        'gender' => 'string',
        'height_id' => 'integer',
        'clothing_size_id'=>'string',
        'shoe_size'=>'string',
        'corrective_glasses'=>'string',
        'change_profession'=>'date',
    ];

    public function height(): BelongsTo
    {
        return $this->belongsTo(Height::class);
    }
    public function clothingSize(): BelongsTo
    {
        return $this->belongsTo(ClothingSize::class);
    }

}
