<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReverseSideReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'date',
        'quantity',
        'percentage_wear',
        'cost',
        'signatures'
    ];
}
