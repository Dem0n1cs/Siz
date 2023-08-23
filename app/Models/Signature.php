<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Signature extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'last_name',
        'first_name',
        'middle_name',
        'dismissal'
    ];
    protected $casts = [
        'position' => 'string',
        'last_name' => 'string',
        'first_name' => 'string',
        'middle_name' => 'string',
        'dismissal' => 'date'
    ];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->last_name.' '.Str::substr($this->first_name, 0, 1).'.'.Str::substr($this->middle_name, 0, 1).'.'
        );
    }
}
