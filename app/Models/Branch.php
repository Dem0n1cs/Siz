<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
    ];

    public function departments(): HasMany
    {
        return $this->HasMany(Department::class);
    }
}
