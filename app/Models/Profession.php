<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;
    protected $fillable = [
        'title'
    ];
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
    ];
}
