<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ppe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'classification_id',
    ];
    protected $casts = [
        'title' => 'string',
        'classification_id' => 'integer',
    ];

    protected function TitleClassification(): Attribute
    {
        return new Attribute(
            get: fn () => $this->title .' (' . $this->classification->title.')'
        );
    }

    public function classification(): BelongsTo
    {
        return $this->belongsTo(Classification::class);
    }

    public function standards(): HasMany
    {
        return $this->HasMany(Standard::class);
    }

    public function standard(): HasOne
    {
        return $this->HasOne(Standard::class);
    }
}
