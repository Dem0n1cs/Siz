<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    use HasFactory;
    protected $fillable = [
        'profession_id',
        'ppe_id',
        'quantity',
        'term_wear',
    ];
    protected $casts = [
        'profession_id' => 'integer',
        'ppe_id' => 'integer',
        'quantity' => 'string',
        'term_wear' => 'string',
    ];

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function ppe()
    {
        return $this->belongsTo(Ppe::class);
    }
}
