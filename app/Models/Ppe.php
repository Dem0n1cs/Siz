<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function standards()
    {
        return $this->HasMany(Standard::class);
    }
}
