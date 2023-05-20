<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'classification_id',
        'wear_period'
    ];
    protected $casts = [
        'title'=>'string',
        'classification_id' => 'integer',
        'wear_period' => 'integer',
    ];

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }
}
