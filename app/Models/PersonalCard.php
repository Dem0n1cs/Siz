<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PersonalCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function frontSide(): HasOne
    {
        return $this->HasOne(FrontSide::class);
    }

    public function height(): HasOne
    {
        return $this->HasOne(Height::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reserveSideGives(): HasMany
    {
        return $this->HasMany(ReverseSideGive::class);
    }

}
